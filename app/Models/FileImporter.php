<?php
/**
 * Created by PhpStorm.
 * User: vanhung
 * Date: 12/29/2015
 * Time: 9:04 PM
 */
namespace App\Models;
use App\Models\CallHistory;
use Framework\Config;
use Framework\DB\Exception\DBException;
use Framework\Exception\FrameworkException;
use League\Csv\Reader;

class FileImporter
{
    private static  $instance=null;
	protected $prices = array(
		'mobilephone' =>
			array (
				'6s' => 0,
				'1s' => 0,
			),
		'telephone' =>
			array (
				'6s' => 0,
				'1s' => 0,
			),
	);
	const FIRST_NUMBER_MOBILES = array(
		120,121,122,126,128,89,90,93,						// MobiFone
		123,124,125,127,129,88,91,94,						// Vinaphone
		162,163,164,165,166,167,168,169,868,96,97,98,		// Viettel
		186,188,92,											// Vietnamobile
		95, 												// S-Fone
		992, 												// VSAT
		199,993,994,995,996,997,							// Gmobile (Beeline)
		998,999, 											// Indochina Telecom
	);

	public function __construct()
	{
		$this->prices = config('prices');
	}

	public static function getInstance()
    {
        if(self::$instance==null)
        {
            self::$instance=new FileImporter();
        }
        return self::$instance;
    }

    public function process($input)
    {
        $start_time=microtime(true);
        try {
            if(!file_exists($input["path_file"])) {
                return false;
            }
            $reader=Reader::createFromPath($input["path_file"]);
            $headerFile=$reader->fetchOne();
            $callingPartyNumber_key=array_search("callingPartyNumber",$headerFile);
            $callingPartyUnicodeLoginUserID_key=array_search("callingPartyUnicodeLoginUserID",$headerFile);
            $originalCalledPartyNumber_key=array_search("originalCalledPartyNumber",$headerFile);
            $dateTimeConnect_key=array_search("dateTimeConnect",$headerFile);
            $duration_key=array_search("duration",$headerFile);
            $email_key=array_search("callingPartyNumber_uri",$headerFile);

            $reader->setOffset(2);//ignore two line begin
            foreach($reader->fetch() as $row) {
				/*foreach($headerFile as $field) {
					$key = array_search($field,$headerFile);
					debug($field.' - '.$row[$key]);
				}*/

                $fromNumber=$callingPartyNumber_key===false?"":$row[$callingPartyNumber_key];
                $username=$callingPartyUnicodeLoginUserID_key===false?"0":$row[$callingPartyUnicodeLoginUserID_key];
                $toNumber=$originalCalledPartyNumber_key===false?"":$row[$originalCalledPartyNumber_key];
                $calledAt=$dateTimeConnect_key===false?"":$row[$dateTimeConnect_key];
                $duration=$duration_key===false?"0":$row[$duration_key];
				$email=$email_key===false?" ":$row[$email_key];
                $currentUser=Users::getInstance()->getOneObjectByField(array("phone_number"=>$fromNumber, 'status' => Users::STATUS_ACTIVE));
				if(!is_object($currentUser)) {
					try {
						if($email != '') {
							$userData = array (
								"name"=>$username != '' ? $username : ($email != '' ? $email : $fromNumber),
								"username"=>$username != '' ? $username : ($email != '' ? $email : $fromNumber),
								"phone_number"=>$fromNumber,
								"email"=>$email,
								"monthly_limited_cost"=>0,
								"created_at"=>array('now()')
							);
							$checkInsert = Users::getInstance()->insert($userData);
							if($checkInsert) {
								$currentUser=Users::getInstance()->getOneObjectByField(array("phone_number"=>$fromNumber, 'status' => Users::STATUS_ACTIVE));
							}
						}
					} catch (\Exception $e) {}

				}
				$actualPrice = $this->getPrice($toNumber, $duration);
				$calledAt = date('Y-m-d h:i:s', $calledAt != '' ? $calledAt : 0);
                $data[] = array (
                    "user_id"=>isset($currentUser)?$currentUser->id:-1,
                    "user_name"=>$username,
                    "from_phone_number"=>$fromNumber,
                    "to_phone_number"=>$toNumber,
                    "duration"=>$duration,
                    "cost"=>$actualPrice,
                    "called_at"=> $calledAt,
                    "created_at"=>array('now()')
                );
				if(is_object($currentUser)) {
					$userBefore = array(
						'monthly_used_cost' => $currentUser->monthly_used_cost - $actualPrice,
					);
					Users::getInstance()->update($userBefore, array('id' => $currentUser->id));
				}
            }
			if(count($data)) {
				$checkResult = CallHistory::getInstance()->inserts(array_keys($data[0]), $data);
				return $checkResult;
			}
        } catch (\PDOException $e) {
			/*Logs::getInstance()->insert(array(
				'log_type' => Logs::EVENT_ERROR,
				'content' => (string)$e->getMessage(),
			));*/
            return false;
        }

        $endtime=microtime(true);
        return $endtime-$start_time;
    }

	public function checkMobilePhoneNumber($number) {
		$firstNumberMobiles = self::FIRST_NUMBER_MOBILES;
		foreach($firstNumberMobiles as $firstNumberMobile) {
			if (preg_match("/^\+?(84|0{$firstNumberMobile})/", $number, $matches)) {
				return true;
			}
		}
		return false;
	}

	public function getPrice($phoneNumber, $duration) {
		if(strlen($phoneNumber) <= 6) {
			return 0;
		}
		$isMobilePhone = $this->checkMobilePhoneNumber($phoneNumber);
		$blocks = $this->secondsToBlocks($duration);
		//is Mobile
		if($isMobilePhone) {
			$block1s = $blocks[0]*$this->prices['mobilephone']['1s'];
			$block6s = $this->prices['mobilephone']['6s'];
			$price = $block6s + $block1s*$blocks[1];
		} else {
			$block1s = $blocks[0]*$this->prices['telephone']['1s'];
			$block6s = $this->prices['telephone']['6s'];
			$price = $block6s + $block1s*$blocks[1];
		}
		return $price;
	}
	public function secondsToBlocks($s) {
		$blocks[0] = 1;
		$blocks[1] = 0;
		$blocks[2] = 0;
		if(intval($s) <= 0) {
			$blocks[0] = 0;
		} else {
			$s -= 6;
			if ($s > 0) {
				/*$m = floor($s / 60);
				$blocks[1] = $m;
				$s -= $m * 60;
				$blocks[2] = $s;*/
				$blocks[1] = $s;
			}
		}
		return $blocks;
	}
}
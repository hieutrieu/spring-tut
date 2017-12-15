<?php
namespace App\Libraries;
/**
 * Created by PhpStorm.
 * User: HIEU TRIEU
 * Date: 10/12/2017
 * Time: 10:03 AM
 * co dinh --> co dinh cung mang, noi hat
 * co dinh --> co dinh khac mang, noi hat
 * co dinh --> co dinh cung mang, lien tinh
 * co dinh --> co dinh khac mang, lien tinh
 * co dinh --> di dong noi mang
 * co dinh --> di dong ngoai mang
 * co dinh --> quoc te (di dong hay co dinh quoc te la giong nhau)
 */
class Phone
{
    private static $instance = null;
    private $phone_number = '';
    private $country_area_codes = array();

    public function __construct($config)
    {
        $this->config = $config;
        foreach ($config['international'] as $area => $value) {
            $this->country_area_codes[$area] = array_map('trim', explode(',', $value['codes']));
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            self::$instance = new Phone($config);
        }
        return self::$instance;
    }

    public function set($phone_number)
    {
        $this->phone_number = str_replace(array('-', '.', ' '), '', $phone_number);
    }

    /**
     * 'QT' => 0, // Ma khu vuc goi quoc te
     * 'DD' => 0, // Di dong: 1 goi di dong; 0: khong goi di dong
     * 'NH' => 1, // Noi hat: 1 goi noi hat; 0: goi lien tinh
     * 'NM' => 0, // Noi mang: 1 goi cung nha mang; 0: goi khac nha mang
     * xac dinh so dien thoai
     **/
    public function parser_phone_number()
    {

        $is_local = $this->is_call_local();
        $is_international = $is_local ? 0 : $this->is_call_international();
        $is_mobile = $is_international ? 0 : $this->is_call_mobile();
        $is_inside_province = $is_mobile ? 0 : $this->is_call_inside_province();
        $phone_parser = [
            'NB' => $is_local, // Quoc te
            'QT' => $is_international, // Quoc te
            'DD' => $is_mobile, // Di dong
            'NH' => $is_inside_province, // Noi hat
            'NM' => $this->is_call_inside_network($is_inside_province), // Noi mang
        ];
        $this->test_dauso($phone_parser);
        return $phone_parser;
    }

    /**
     * Goi noi bo
     **/
    private function is_call_local()
    {
        if (strlen($this->phone_number) <= $this->config['phone']['local']['max_length']) {
            return 1;
        }
        return 0;
    }
    /**
     * Goi quoc te
     **/
    private function is_call_international()
    {
        $acccodes = $this->country_area_codes;
        if (preg_match("/^\+?(00)/", $this->phone_number, $matches)) {
            foreach ($acccodes as $area => $cccodes) {
                foreach ($cccodes as $cccode) {
                    if (preg_match("/^\+?(00{$cccode})/", $this->phone_number, $matches)) {
                        return $area;
                    }
                }
            }
        }
        return 0;
    }

    /**
     * Goi trong tinh (noi hat), ngoai tinh
     **/
    private function is_call_inside_province()
    {
        $area_code = $this->config['telephone']['nh']['code'];
        if (preg_match("/^\+?(84|0{$area_code})/", $this->phone_number, $matches)) {
            return 1;
        }
        return 0;
    }

    /**
     * Goi mobile
     **/
    private function is_call_mobile()
    {
        if (trim($this->config['mobilephone']['nm']['codes']) != '') {
            $firstNumberMobiles = array_map('trim', explode(',', $this->config['mobilephone']['nm']['codes']));
            foreach ($firstNumberMobiles as $firstNumberMobile) {
                if (preg_match("/^\+?(84|0{$firstNumberMobile})/", $this->phone_number, $matches)) {
                    return 1;
                }
            }
        }
        if (trim($this->config['mobilephone']['km']['codes']) != '') {
            $firstNumberMobiles = array_map('trim', explode(',', $this->config['mobilephone']['km']['codes']));
            foreach ($firstNumberMobiles as $firstNumberMobile) {
                if (preg_match("/^\+?(84|0{$firstNumberMobile})/", $this->phone_number, $matches)) {
                    return 2;
                }
            }
        }
        // Tim Mobile
        return 0;
    }

    /**
     * Goi noi mang, ngoai mang
     **/
    private function is_call_inside_network($is_inside_province)
    {
        $firstNumberTelephones = array_map('trim', explode(',', $this->config['telephone']['nm']['codes']));
        if ($is_inside_province) {
            $first_pattern = strval($this->config['telephone']['nh']['code']);
        } else {
            $first_pattern = "[0-9]{1,3}";
        }
        foreach ($firstNumberTelephones as $firstNumberTelephone) {
            $first_number = $first_pattern . strval($firstNumberTelephone);
            if (preg_match("/^\+?(84|0{$first_number})/", $this->phone_number, $matches)) {
                return 1;
            }
        }
        return 0;
    }

    /**
     * Test dau so
     * @param $phone_parser
     * @param $phone_number
     */
    public function test_dauso($phone_parser)
    {
        $t = ['Phone_number' => "Phone: " . $this->phone_number];
        if ($phone_parser['NB'] == 0) {
            if ($phone_parser['QT']) {
                $t['QT'] = "Quoc te - khu vuc: " . $phone_parser['QT'];
            } else {
                if ($phone_parser['DD'] == 1) {
                    $t['DD'] = "Di dong - Noi mang";
                } elseif ($phone_parser['DD'] == 2) {
                    $t['DD'] = "Di dong - Ngoai mang";
                } else {
                    if ($phone_parser['NH']) {
                        $t['NH'] = "Noi hat ";
                    } else {
                        $t['NH'] = "Lien tinh";
                    }
                    if ($phone_parser['NM']) {
                        $t['NM'] = "Noi mang";
                    } else {
                        $t['NM'] = "Ngoai mang";
                    }
                }
            }
        } else {
            $t['NB'] = "Noi bo";
        }
        debug(implode(' - ', $t));
    }
}
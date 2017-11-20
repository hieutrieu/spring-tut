<?php
/**
 * Created by PhpStorm.
 * User: hajime3333
 * Date: 5/31/14
 * Time: 3:49 AM
 */
namespace App\Models;
use App\Libraries\APIException;
use App\Models\Base\ModelBase;

class BackgroundProcess extends ModelBase
{
    private static $bgp;
    const NUMBER_LIMIT_PROCESS = 6;
    const PRIORITY_HIGHTEST = 'hightest';
    const PRIORITY_HIGH = 'hight';
    const PRIORITY_MIDDLE = 'middle';
    const PRIORITY_LOW = 'slow';

    public function __construct()
    {
        parent::__construct('process');
        $this->initialize();
    }

    public function initialize()
    {
        set_time_limit(30);
    }

    public static function getInstance()
    {
        if (self::$bgp == null) {
            self::$bgp = new BackgroundProcess();
        }
        return self::$bgp;
    }

    public function process($processId)
    {
        if (self::countActiveProcess() < self::NUMBER_LIMIT_PROCESS) {
            if ($processId > 0) {
                $r = $this->getObjectsByField(array('id' => $processId));
                if (isset($r[0]) && $r[0]['status'] == 'waiting') {
                    $this->update(array('status' => 'processing', 'started_at' => array('now()')), array('id' => $processId));

                    self::run($r[0]['process']);
                    $this->delete(array('id'=>$processId));
                }
            }
        }
    }

    /**
     * @return mixed
     * Get count process is available in 2 minutes
     */
    public function countActiveProcess()
    {
        $r = $this->db->query("SELECT count(*) as cnt
            FROM process
            WHERE status = 'processing' AND (CURRENT_TIMESTAMP-started_at) < 200"
        );
        return $r[0]['cnt'];
    }

    private function run($command)
    {
        try {
            //if ($this->getPathBase() == null) {
            $process = "http://" . $_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'] . $command;
            exec("wget -O- '" . $process . "' > /dev/null");
            //Test on window
            //exec('cmd /c start '.$process);
            /*if (strncasecmp(PHP_OS, 'WIN', 3) == 0) {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $process);
                curl_exec($ch);
            }*/
        } catch (Exception $e) {
            //LogHelper::error("Process Error:".$e->getTraceAsString());
        }
    }

    /**
     * Hieu Trieu
     * Get batch process
     **/
    public function getBatchProcess($limit)
    {
        $sql = "SELECT *
                FROM process
                WHERE status='waiting' AND scheduled_at < now()
                ORDER BY FIELD(priority, 'hightest','hight', 'middle', 'slow'), id
                LIMIT {$limit}
                ";
        $process = $this->db->select($sql);
        return $process;
    }

    /**
     * @param $process
     * @return int
     */
    public function checkProcessExsist($process)
    {
        $result = $this->db->select("SELECT * FROM process WHERE process LIKE '%{$process}%'");
        if (count($result) > 0) {
            return $result;
        } else
            return -1;
    }
}

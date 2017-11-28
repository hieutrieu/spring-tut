<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/24/2015
 * Time: 2:26 PM
 */

namespace App\Models;

use App\Models\Base\ModelBase;

class FileScan extends ModelBase
{
    const STATUS_WAITING = 'waiting';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SUCCESS = 'success';
    const STATUS_FAILED = 'failed';
    private static $instance = null;

    public function __construct()
    {
        parent::__construct('file_scans');
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new FileScan();
        }
        return self::$instance;
    }

    public function getFileScaned($limit) {
        $status = FileScan::STATUS_WAITING;
        $sql = "SELECT id , path_file, filename
                FROM `{$this->tableName}`
                WHERE `status` = '{$status}'
                ORDER BY id ASC 
                LIMIT {$limit}
            ";

        $items = $this->db->select($sql);
        return $items;
    }
}
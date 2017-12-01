<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/24/2015
 * Time: 2:26 PM
 */

namespace App\Models;

use App\Models\Base\ModelBase;

class CallHistory extends ModelBase
{
    private static $instance = null;

    public function __construct()
    {
        parent::__construct('call_histories');
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new CallHistory();
        }
        return self::$instance;
    }

    public function getAllHistoryByUsers($condition = '', $page = 0, $limit = 20)
    {
        try {
            $page = $page == 0 ? 1 : $page;
            $offset = $limit * ($page - 1);

            // Get total items
            if ($condition != '') {
                $where = " WHERE {$condition}";
            } else {
                $where = '';
            }
            $countSql = "SELECT COUNT(DISTINCT user_id) AS total
                FROM `{$this->tableName}`
                {$where}
            ";
            $totalArr = $this->db->select($countSql);
            // Get all videos by limit and offset
            $sql = " SELECT user_id, SUM(cost) total_cost, SUM(duration) total_duration
                FROM `{$this->tableName}`
                {$where}
                GROUP BY user_id
                LIMIT {$limit} OFFSET {$offset}
            ";

            $items = $this->db->select($sql);
            $items = array('total' => intval($totalArr['0']['total']), 'items' => $items);
        } catch (DBException $e) {
            $items = array('total' => 0, 'items' => array());
        } catch (\Exception $e) {
            $items = array('total' => 0, 'items' => array());
        }

        return $items;
    }

    public function getAllHistoryByUser($condition = '')
    {
        try {
            if ($condition != '') {
                $where = " WHERE {$condition}";
            } else {
                $where = '';
            }
            $sql = "{$this->baseQuery} `{$this->tableName}` {$where}
                ORDER BY created_at DESC
            ";

            $items = $this->db->select($sql);
            $items = array('items' => $items);
        } catch (DBException $e) {
            $items = array('items' => array());
        }

        return $items;
    }

    public function getAllHistoryByGroup($condition = '')
    {
        try {
            if ($condition != '') {
                $where = " WHERE {$condition}";
            } else {
                $where = '';
            }
            $sql = " SELECT user_id, SUM(cost) total_cost, SUM(duration) total_duration
                FROM `{$this->tableName}`
                {$where}
                GROUP BY user_id
            ";
            $items = $this->db->select($sql);
            $items = array('items' => $items);
        } catch (DBException $e) {
            $items = array('items' => array());
        }

        return $items;
    }

}
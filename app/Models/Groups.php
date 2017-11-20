<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/24/2015
 * Time: 2:26 PM
 */

namespace App\Models;

use App\Models\Base\ModelBase;

class Groups extends ModelBase
{
    private static $instance = null;
    public function __construct()
    {
        parent::__construct('group');
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Groups();
        }
        return self::$instance;
    }

    /**
     * Check access permission when user change data
     */
    public function checkAccess($permission, $groupId, $originGroupId){
        switch($permission) {
            case Users::ROLE_ADMIN:
                return true;
            case Users::ROLE_GROUP:
                return $groupId == $originGroupId;
        }
        // Get
        return false;
    }

    public function getPrice($username)
    {
        try {

            $sql = " select time,price_start,price_end FROM `user`
                     INNER JOIN `group`
                        ON `user`.group_id=`group`.id
                     WHERE
                     `user`.username='{$username}'
            ";

            $items = $this->db->select($sql);
            $items = array('items' => $items);
        } catch (DBException $e) {
            $items = array('items' => array());
        }

        return $items;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/24/2015
 * Time: 2:26 PM
 */

namespace App\Models;

use App\Models\Base\ModelBase;

class Users extends ModelBase
{
    const ROLE_ADMIN = 'admin';
    const ROLE_GROUP = 'group';
    const ROLE_USER = 'user';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_DELETE = 'delete';
    private static $instance = null;
    
    public function __construct()
    {
        parent::__construct('user');
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Users();
        }
        return self::$instance;
    }
}
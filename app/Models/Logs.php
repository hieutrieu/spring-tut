<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/24/2015
 * Time: 2:26 PM
 */

namespace App\Models;

use App\Models\Base\ModelBase;

class Logs extends ModelBase
{
    const EVENT_ERROR = 'error';
    const EVENT_INFO = 'info';
    private static $instance = null;
    
    public function __construct()
    {
        parent::__construct('logs');
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Logs();
        }
        return self::$instance;
    }
}
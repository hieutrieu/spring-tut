<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/24/2015
 * Time: 2:26 PM
 */

namespace App\Models;

use App\Models\Base\ModelBase;

class Process extends ModelBase
{
    private static $instance = null;
    public function __construct()
    {
        parent::__construct('process');
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Process();
        }
        return self::$instance;
    }
}
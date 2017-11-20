<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/24/2015
 * Time: 2:26 PM
 */

namespace App\Models;

use App\Models\Base\ModelBase;

class Openspace extends ModelBase
{
    private static $instance = null;
    public function __construct()
    {
        parent::__construct('open_spaces');
    }

    public static function getInstance() {
        if(self::$instance == null) {
            self::$instance = new Openspace();
        }
        return self::$instance;
    }
}
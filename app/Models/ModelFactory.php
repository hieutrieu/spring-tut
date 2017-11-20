<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 9/14/2015
 * Time: 9:44 AM
 */

namespace App\Models;

use App\Libraries\APIException;
use Framework\Input;

class ModelFactory
{
    public static $_refClass = "App\Models\\";
    public static function getInstance($modelName)
    {
        try {
            $version = strtoupper(Input::get('version', ''));
            if($version != '') {
                $folderVersion = str_replace('.', '_', $version);
                $className = self::$_refClass .  $folderVersion . '\\' . ucfirst($modelName);
            } else {
                $className = self::$_refClass . ucfirst($modelName);
            }
            return $className::getInstance();
        } catch(APIException $e) {

        }
    }
}
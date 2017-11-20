<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/24/2015
 * Time: 9:59 AM
 */

namespace App\Adapter;

use Redis;
use Framework\Config;

class CacheAccessor
{
    private static $instance = null;
    private $redis;
    private $prefix = 'teleme:';

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new CacheAccessor();
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->open(Config::get('redis.servers.default.host'), Config::get('redis.servers.default.port'));
    }

    /**
     * @param $group
     * @param $key
     * @return bool
     */
    public function exists($group, $key)
    {
        $cacheKey = $this->prefix.$group.":".$key;
        debug($cacheKey,1);
        if ($this->redis->exists($cacheKey)) {
            return true;
        } else {
            return false;
        }
    }

    public function set($group, $key, $value, $timeout = 0)
    {
        $cacheKey = $this->prefix.$group.":".$key;
        $this->redis->set($cacheKey, json_encode($value,JSON_UNESCAPED_UNICODE), $timeout);
        return true;
    }


}
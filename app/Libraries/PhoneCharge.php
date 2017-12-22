<?php
namespace App\Libraries;

/**
 * Created by PhpStorm.
 * User: HIEU TRIEU
 * Date: 10/12/2017
 */
use App\Libraries\Phone;

class PhoneCharge
{
    private static $instance = null;

    public function __construct($config)
    {
        $this->config = $config;
        $this->phone_obj = Phone::getInstance($config);

    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            self::$instance = new PhoneCharge($config);
        }
        return self::$instance;
    }

    /**
     * Tinh phi
     **/
    public function phone_charged($phone_number, $seconds)
    {
        $seconds = intval($seconds);
        $cost = 0;
        if ($seconds > 0) {
            $this->phone_obj->set($phone_number);
            $phone_parser = $this->phone_obj->parser_phone_number();
            if ($phone_parser['NB'] == 0) {
                if ($phone_parser['QT']) {
                    $cost = $this->amount_international($phone_parser['QT'], $seconds);
                } else {
                    if ($phone_parser['DD']) {
                        $cost = $this->amount_mobile($phone_parser['DD'], $seconds);
                    } else {
                        $cost = $this->amount_province($phone_parser['NH'], $phone_parser['NM'], $seconds);
                    }
                }
            }
        }
        return $cost;
    }

    public function amount_international($area_code, $s)
    {
        $m = ceil($s / 60);
        $cost = $m * $this->config['international'][$area_code];
        return $cost;
    }

    /**
     * block6s + (so giay - 6) * block1s => cho phut dau tien
     * Cac phut sau tinh down gia theo phut (tu 1s-> 60s)
     * @param $s
     */
    public function amount_mobile($is_noimang, $s)
    {
        //x = (t/a*60)*Block1' + 1*Block6s + (t-a*60-6)*Block1s
        $block6s = $block1s = $block1m = 0;
        $key = $is_noimang == 1 ? 'nm' : 'km';
        $m = floor($s / 60);
        $block1m = $m * $this->config['mobilephone'][$key]['1p'];

        $first_60 = $s - $m*60;
        if ($first_60 > 0) {
            $block6s = $this->config['mobilephone'][$key]['6s'];
        }
        if ($first_60 > 6) {
            $block1s = ($first_60 - 6) * $this->config['mobilephone'][$key]['1s'];
        }
        return $block1s + $block6s + $block1m;
    }

    public function amount_mobile_($is_noimang, $s)
    {
        //x = (t/a*60)*Block1' + 1*Block6s + (t-a*60-6)*Block1s
        $key = $is_noimang == 1 ? 'nm' : 'km';
        $first_60 = ($s <= 60) ? $s : 60;
        $s -= $first_60;

        $block6s = $this->config['mobilephone'][$key]['6s'];
        $block1s = 0;
        if ($first_60 > 6) {
            $block1s = ($first_60 - 6) * $this->config['mobilephone'][$key]['1s'];
        }
        $m = ceil($s / 60);
        $block1m = $m * $this->config['mobilephone'][$key]['1p'];
        return $block1s + $block6s + $block1m;
    }

    public function amount_province($is_inside_province, $is_inside_network, $s)
    {
        if ($is_inside_province) {
            $m = ceil($s / 60);
            $cost = $m * $this->config['telephone']['nh']['price'];
        } else {
            $block6s = $block1s = $block1m = 0;
            $key = $is_inside_network == 1 ? 'nm' : 'km';
            $m = floor($s / 60);
            $block1m = $m * $this->config['telephone'][$key]['1p'];

            $first_60 = $s - $m*60;
            if ($first_60 > 0) {
                $block6s = $this->config['telephone'][$key]['6s'];
            }
            if ($first_60 > 6) {
                $block1s = ($first_60 - 6) * $this->config['telephone'][$key]['1s'];
            }
            $cost = $block1s + $block6s + $block1m;
        }
        return $cost;
    }
}
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
    protected $prices = array(
        'mobilephone' => array(
            // Noi mang
            'nm' => array(
                '6s' => 107.10,
                '1s' => 17.78,
                '1p' => 1067
            ),
            // Khac mang
            'km' => array(
                '6s' => 107.10,
                '1s' => 17.78,
                '1p' => 1067
            )
        ),
        'telephone' => array(
            // Noi hat
            'nh' => 220,
            // Noi mang
            'nm' => array(
                '6s' => 84,
                '1s' => 14,
                '1p' => 840
            ),
            // Khac mang
            'km' => array(
                '6s' => 84,
                '1s' => 14,
                '1p' => 840
            )
        ),
        'international' => array(
            '1' => 1815,
            '2' => 2805,
            '3' => 3564,
            '4' => 4752,
            '5' => 3410,
        ),
    );
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
        $phone_number = str_replace(array('-', '.', ' '), '', $phone_number);
        if (strlen($phone_number) <= 6 || intval($seconds) <= 0) {
            return 0;
        }
        $this->phone_obj->set($phone_number);
        $phone_parser = $this->phone_obj->parser_phone_number();
        $seconds = intval($seconds);
        if ($phone_parser['QT']) {
            $cost = $this->amount_international($phone_parser['QT'], $seconds);
        } elseif ($phone_parser['DD']) {
            $cost = $this->amount_mobile($seconds);
        } else {
            $cost = $this->amount_province($phone_parser['NH'], $phone_parser['NM'], $seconds);
        }
        return $cost;
    }

    public function amount_international($area_code, $s)
    {
        $m = ceil($s / 60);
        $cost = $m * $this->prices['international'][$area_code];
        return $cost;
    }

    /**
     * block6s + (so giay - 6) * block1s => cho phut dau tien
     * Cac phut sau tinh down gia theo phut (tu 1s-> 60s)
     * @param $s
     */
    public function amount_mobile($s)
    {
        $first_60 = ($s <= 60) ? $s : 60;
        $s -= $first_60;

        $block6s = $this->prices['mobilephone']['nm']['6s'];
        $block1s = 0;
        if ($first_60 > 6) {
            $block1s = ($first_60 - 6) * $this->prices['mobilephone']['nm']['1s'];
        }
        $m = ceil($s / 60);
        $block1m = $m * $this->prices['mobilephone']['nm']['1p'];
        return $block1s + $block6s + $block1m;
    }

    public function amount_province($is_inside_province, $is_inside_network, $s)
    {
        if ($is_inside_province) {
            $m = ceil($s / 60);
            $cost = $m * $this->prices['telephone']['nh'];
        } else {
            $first_60 = ($s <= 60) ? $s : 60;
            $s -= $first_60;
            if ($is_inside_network) {
                $key = 'nm';
            } else {
                $key = 'km';
            }
            $block6s = $this->prices['telephone'][$key]['6s'];
            $block1s = 0;
            if ($first_60 > 6) {
                $block1s = ($first_60 - 6) * $this->prices['telephone'][$key]['1s'];
            }
            $m = ceil($s / 60);
            $block1m = $m * $this->prices['telephone'][$key]['1p'];
            $cost = $block1s + $block6s + $block1m;
        }
        return $cost;
    }
}
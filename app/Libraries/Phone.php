<?php
namespace App\Libraries;
/**
 * Created by PhpStorm.
 * User: HIEU TRIEU
 * Date: 10/12/2017
 * Time: 10:03 AM
 * c? ??nh --> c? ??nh cùng m?ng, n?i h?t
 * c? ??nh --> c? ??nh khác m?ng, n?i h?t
 * c? ??nh --> c? ??nh cùng m?ng, liên t?nh
 * c? ??nh --> c? ??nh khác m?ng, liên t?nh
 * c? ??nh --> di ??ng n?i m?ng
 * c? ??nh --> di ??ng ngo?i m?ng
 * c? ??nh --> qu?c t? (di d?ng hay c? ??nh qu?c t? gi?ng nhau)
 */
class Phone
{
    private static $instance = null;
    private $phone_number = '';
    private $country_area_codes = array();

    public function __construct($config)
    {
        $this->config = $config;
        foreach ($config['international'] as $area => $value) {
            $this->country_area_codes[$area] = array_map('trim', explode(',', $value['codes']));
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            self::$instance = new Phone($config);
        }
        return self::$instance;
    }

    public function set($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * 'QT' => 0, // Ma khu vuc goi quoc te
     * 'DD' => 0, // Di dong: 1 goi di dong; 0: khong goi di dong
     * 'NH' => 1, // Noi hat: 1 goi noi hat; 0: goi lien tinh
     * 'NM' => 0, // Noi mang: 1 goi cung nha mang; 0: goi khac nha mang
     * xac dinh so dien thoai
     **/
    public function parser_phone_number()
    {
        $is_international = $this->is_call_international();
        $is_mobile = $is_international ? 0 : $this->is_call_mobile();
        $is_inside_province = $is_mobile ? 0 : $this->is_call_inside_province();
        $phone_parser = [
            'QT' => $is_international, // Quoc te
            'DD' => $is_mobile, // Di dong
            'NH' => $is_inside_province, // Noi hat
            'NM' => $this->is_call_inside_network($is_inside_province), // Noi mang
        ];
        $this->test_dauso($phone_parser, $this->phone_number);
        return $phone_parser;
    }

    /**
     * Goi quoc te
     **/
    private function is_call_international()
    {
        $acccodes = $this->country_area_codes;
        if (preg_match("/^\+?(00)/", $this->phone_number, $matches)) {
            foreach ($acccodes as $area => $cccodes) {
                foreach ($cccodes as $cccode) {
                    if (preg_match("/^\+?(00{$cccode})/", $this->phone_number, $matches)) {
                        return $area;
                    }
                }
            }
        }
        return 0;
    }

    /**
     * Goi trong tinh (noi hat), ngoai tinh
     **/
    private function is_call_inside_province()
    {
        $area_code = $this->config['area_code'];
        if (preg_match("/^\+?(84|0{$area_code})/", $this->phone_number, $matches)) {
            return 1;
        }
        return 0;
    }

    /**
     * Goi mobile
     **/
    private function is_call_mobile()
    {
        if (trim($this->config['first_mobiphone']['nm']) != '') {
            $firstNumberMobiles = array_map('trim', explode(',', $this->config['first_mobiphone']['nm']));
            foreach ($firstNumberMobiles as $firstNumberMobile) {
                if (preg_match("/^\+?(84|0{$firstNumberMobile})/", $this->phone_number, $matches)) {
                    return 1;
                }
            }
        }
        if (trim($this->config['first_mobiphone']['km']) != '') {
            $firstNumberMobiles = array_map('trim', explode(',', $this->config['first_mobiphone']['km']));
            foreach ($firstNumberMobiles as $firstNumberMobile) {
                if (preg_match("/^\+?(84|0{$firstNumberMobile})/", $this->phone_number, $matches)) {
                    return 2;
                }
            }
        }
        // Tim Mobile
        return 0;
    }

    /**
     * Goi noi mang, ngoai mang
     **/
    private function is_call_inside_network($is_inside_province)
    {
        $firstNumberTelephones = array_map('trim', explode(',', $this->config['first_telephone']['nm']));
        if ($is_inside_province) {
            $first_pattern = strval($this->config['area_code']);
        } else {
            $first_pattern = "[0-9]{1,3}";
        }
        foreach ($firstNumberTelephones as $firstNumberTelephone) {
            $first_number = $first_pattern . strval($firstNumberTelephone);
            if (preg_match("/^\+?(84|0{$first_number})/", $this->phone_number, $matches)) {
                return 1;
            }
        }
        return 0;
    }

    /**
     * Test dau so
     * @param $phone_parser
     * @param $phone_number
     */
    public function test_dauso($phone_parser, $phone_number)
    {
        $t = ['Phone_number' => "Phone: " . $phone_number,];
        if ($phone_parser['QT']) {
            $t['QT'] = "Goi quoc te voi khu vuc: " . $phone_parser['QT'];
        } else {
            if ($phone_parser['DD'] == 1) {
                $t['DD'] = "Goi di dong --- Goi noi mang";
            } elseif ($phone_parser['DD'] == 2) {
                $t['DD'] = "Goi di dong --- Goi ngoai mang";
            } else {
                if ($phone_parser['NH']) {
                    $t['NH'] = "Goi noi hat ";
                } else {
                    $t['NH'] = "Goi lien tinh";
                }
                if ($phone_parser['NM']) {
                    $t['NM'] = "Goi noi mang ";
                } else {
                    $t['NM'] = "Goi ngoai mang";
                }
            }
        }
        debug(implode(' --- ', $t));
    }
}
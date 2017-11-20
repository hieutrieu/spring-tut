<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/26/2015
 * Time: 9:34 AM
 */
namespace App\Libraries;


class Helper
{
    const STATUS_ACTIVE = 'Y';
    const STATUS_INACTIVE = 'N';
    const STATUS_DELETE = 'O';
    const STATUS_ENABLE = 1;
    const STATUS_DISABLE = 0;

    const CURRENCY = 'VND';

    public static function getIconStatus($value, $label = 1) {
        $status = '';
        switch($value) {
            case self::STATUS_ACTIVE:
                if($label) {
                    $status = "<span class='label label-success' title='Active' data-toggle='tooltip' data-placement='top'><i class='fa fa-check'></i></span>";
                } else {
                    $status = "<i class='fa fa-check-square-o'></i>";
                }
                break;
            case self::STATUS_INACTIVE:
                if($label) {
                    $status = "<span class='label label-warning' title='Inactive' data-toggle='tooltip' data-placement='top'><i class='fa fa-times'></i></span>";
                } else {
                    $status = "<i class='fa fa-square-o'></i>";
                }
                break;
            case self::STATUS_DELETE:
                if($label) {
                    $status = "<span class='label label-danger' title='Trash' data-toggle='tooltip' data-placement='top'><i class='fa fa-trash-o'></i></span>";
                } else {
                    $status = "<i class='fa fa-trash-o'></i>";
                }
                break;
        }
        return $status;
    }
    public static function getIconTimeStatus($value, $label = 1) {
        $status = '';
        switch($value) {
            case self::STATUS_ENABLE:
                if($label) {
                    $status = "<span class='label label-success' title='Enable' data-toggle='tooltip' data-placement='top'><i class='fa fa-clock-o'></i></span>";
                } else {
                    $status = "<i class='fa fa-check-square-o'></i>";
                }
                break;
            case self::STATUS_DISABLE:
                if($label) {
                    $status = "<span class='label label-danger' title='Disable' data-toggle='tooltip' data-placement='top'><i class='fa fa-clock-o'></i></span>";
                } else {
                    $status = "<i class='fa fa-check-square-o'></i>";
                }
                break;
        }
        return $status;
    }

    public static function limitString($input, $length, $ellipses = true, $strip_html = true) {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...';
        }

        return $trimmed_text;
    }

    public static function formatCurrency($money, $decimals = 2, $showUnit = 1) {
        $unit = $showUnit ? self::CURRENCY : '';
        return number_format($money, $decimals) .' '.  $unit;
    }
}
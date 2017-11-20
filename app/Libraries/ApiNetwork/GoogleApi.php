<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 10/6/2015
 * Time: 10:52 AM
 */

namespace App\Libraries\ApiNetwork;


class GoogleApi
{
    static function getLatLngFromAddress($address)
    {
        $address = urlencode($address);
        $locations = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address={$address}");
        $result = json_decode($locations);
        $results = array();
        if ($result->status != 'ZERO_RESULTS') {
            $results = $result->results;
        }
        return $results;
    }
}
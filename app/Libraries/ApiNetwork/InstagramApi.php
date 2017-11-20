<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 10/6/2015
 * Time: 10:52 AM
 */

namespace App\Libraries\ApiNetwork;


use Framework\Session\Session;

class InstagramApi
{
    static function searchMemberByLatLng($lat, $lng)
    {
        $session = Session::getInstance();
        $token = $session->get('instagram_access_token');
        $accessToken = "access_token={$token}&distance=1000";
        $results = file_get_contents("https://api.instagram.com/v1/locations/search?lat={$lat}&lng={$lng}&{$accessToken}");
        $result = json_decode($results);
        $data = array();
        if ($result->meta->code == 200) {
            $data = $result->data;
        }
        return $data;
    }

    static function getMediaByLocation($locationId)
    {
        $session = Session::getInstance();
        $token = $session->get('instagram_access_token');
        $accessToken = "access_token={$token}&distance=1000";
        $results = file_get_contents("https://api.instagram.com/v1/locations/{$locationId}/media/recent?{$accessToken}");
        $result = json_decode($results);
        return $result->data;
    }

    static function likePhoto($photoId)
    {
        $session = Session::getInstance();
        $token = $session->get('instagram_access_token');
        $url = "https://api.instagram.com/v1/media/{$photoId}/likes";
        $fields = array(
            'access_token'       =>      $token,
            'action'             =>      'like'
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($curl, CURLOPT_POST, count($fields));
        curl_setopt($curl,CURLOPT_POSTFIELDS, http_build_query($fields));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        if ($result == "OK") {
            echo 'Ok';
        } else {
            echo "Fail";
        }

        curl_close($curl);
    }
}
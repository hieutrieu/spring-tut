<?php
/**
 * Created by PhpStorm.
 * User: HIEUTRIEU
 * Date: 8/26/2015
 * Time: 9:34 AM
 */
function debug($strString, $exit = false) {
    print '<pre>';
    print_r($strString);
    print '</pre>';
    if($exit) exit();
}
function baseUrl(){
    return '/';
    //return $_SERVER['CONTEXT_PREFIX'];
}
function url($url){
    return baseUrl().$url;
}
function config($variable) {
    return \Framework\Config::get($variable);
}
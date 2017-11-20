<?php
define('__APP__', __DIR__ . '/..');
date_default_timezone_set("UTC");
try {
    require __APP__ . '/vendor/autoload.php';
    include_once __APP__ . '/app/Libraries/Common.php';
    require __APP__ . '/route.php';
} catch (\Framework\Exception\FrameworkException $e) {
    debug($e->getTraceAsString());
}


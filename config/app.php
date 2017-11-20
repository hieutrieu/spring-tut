<?php
return array(
    'debug' => true,
    'site_name' => 'Telephone Cost',
    'site_name_short' => 'Telephone',
    'scanDir' => 'C:\\Users\\Administrator\\Desktop\\log-bill',
	'limit_scan_file' => 1,
	'blockPrices' => array(
		'mobilephone' => array(
			'1s' => 16.16,
			'6s' => 97.36,
			'60s' => 970,
		),
		'telephone' => array(
			'1s' => 12.73,
			'6s' => 76.36,
			'60s' => 763.78,
		),
	),
);
<?php
return array(
	'ze_theme' => array(
		'default_theme' => "zf2-basic",
		'custom_theme_path' => true,
		'theme_paths' => array(
			__DIR__ . "/../../themes/{theme}",
		),
		/* 'routes' => array(
			// 'theme_name' => array('route_names'),
		), */
		'adapters' => array(
			"ZeTheme\Adapter\Configuration",
			//"ZeTheme\Adapter\Route",
			//"ZeTheme\Adapter\Session",
		),
	),
);
<?php
/**
 * BB's Zend Framework 2 Components
 * 
 * BaseApp
 *
 * @package		[MyApplication]
 * @package		BB's Zend Framework 2 Components
 * @package		BaseApp
 * @author		Björn Bartels [dragon-projects.net] <info@dragon-projects.net>
 * @link		http://gitlab.dragon-projects.de:81/groups/zf2
 * @license		http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @copyright	copyright (c) 2016 Björn Bartels [dragon-projects.net] <info@dragon-projects.net>
 */

return array(
	'navigation' => array(
		'default' => array(
			array(
				'label' => 'home',
				'icon'	=> 'home',
				'route' => 'home',
				'order' => 0,
				'pages'			=> array(
					'testpage' => array(
						'label'			=> 'test page',
						'icon'			=> 'exclamation-triangle',
						'route'			=> 'application/default',
						'controller' 	=> 'index',
						'action' 		=> 'test',
						'resource'		=> 'mvc:admin',
					),
				),
			),
			array(
				'label'			=> 'help',
				'icon'			=> 'question-circle',
				'route'			=> 'application/default',
				'controller'	=> 'index',
				'action' 		=> 'notimplementedyet',
				'order'			=> 99999,
				'pages'			=> array(
					array(
						'label'			=> 'help',
						'icon'			=> 'question-circle',
						'route'			=> 'application/default',
						'controller'	=> 'index',
						'action' 		=> 'help',
					),
					array(
						'label'			=> 'support',
						'icon'			=> 'envelope',
						'route'			=> 'application/default',
						'controller'	=> 'index',
						'action' 		=> 'support',
					),
					array(
						'label' 		=> 'about',
						'icon'			=> 'info-circle',
						'route'			=> 'application/default',
						'controller'	=> 'index',
						'action' 		=> 'about',
					),
				),
			),
		),
	),
);
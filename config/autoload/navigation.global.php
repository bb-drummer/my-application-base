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
				'pages'			=> array(
					array(
						'label'			=> 'test page',
						'icon'			=> 'exclamation-triangle',
						'route'			=> 'application/default',
						'controller' 	=> 'index',
						'action' 		=> 'test',
						'resource'		=> 'mvc:admin',
					),
				),
			),
			/*array(
				'label'			=> 'YourModule',
				'route' 		=> 'yourmodule/route',
				'controller'	=> 'your_index_controller_or_other',
				'action' 		=> 'your_index_action_or_other',
				'resource'		=> 'mvc:yourmodule.resource',
				'pages' => array(
					array(
						'label' 		=> 'YourModule Action/Item',
						'route' 		=> 'yourmodule/route',
						'resource'		=> 'mvc:yourmodule.resource',
						'controller'	=> 'your_controller',
						'action' 		=> 'your_action',
					),
				),
			),*/
			array(
				'label' => 'account',
				'icon'	=> 'user',
				'route' => 'zfcuser',
				'badge' => array('type' => 'warning', 'value' => '!!!', 'title' => 'Remember to change your password after registration!'),
				'pages'			=> array(
					array(
						'label'			=> 'login',
						'icon'			=> 'power-off',
						'route'			=> 'zfcuser/login',
						'resource'		=> 'mvc:nouser',
					),
					array(
						'label'			=> 'register',
						'icon'			=> 'link',
						'route'			=> 'zfcuser/register',
						'resource'		=> 'mvc:nouser',
					),
					array(
						'label'			=> 'user profile',
						'icon'			=> 'photo',
						'route'			=> 'zfcuser',
						'resource'		=> 'mvc:user',
					),
					array(
						'label'			=> 'edit profile',
						'icon'			=> 'edit',
						'route'			=> 'zfcuser/edituserprofile',
						'resource'		=> 'mvc:user',
					),
					array(
						'label'			=> 'edit userdata',
						'icon'			=> 'user',
						'route'			=> 'zfcuser/edituserdata',
						'resource'		=> 'mvc:user',
					),
					array(
						'label'			=> 'change email',
						'icon'			=> 'envelope',
						'route'			=> 'zfcuser/changeemail',
						'resource'		=> 'mvc:user',
					),
					array(
						'label'			=> 'change password',
						'icon'			=> 'lock',
						'route'			=> 'zfcuser/changepassword',
						'resource'		=> 'mvc:user',
					),
					array(
						'label'			=> 'logout',
						'icon'			=> 'power-off',
						'route'			=> 'zfcuser/logout',
						'resource'		=> 'mvc:user',
					),

					array(
						'label'			=> 'reset password',
						'icon'			=> 'life-ring',
						'route'			=> 'userrequestpasswordreset',
						'resource'		=> 'mvc:nouser',
					),

					array(
						'label'			=> 'reset password',
						'route'			=> 'userresetpassword',
						'visible'		=> false,
					),
						
					array(
						'label'			=> 'user confirmation',
						'route'			=> 'userconfirmation',
						'visible'		=> false,
					),
					array(
						'label'			=> 'user activation',
						'route'			=> 'useractivation',
						'resource'		=> 'mvc:admin',
						'visible'		=> false,
					),
				),
			),
			array(
				'label'			=> 'admin',
				'icon'			=> 'cogs',
				'route'			=> 'admin',
				'resource'		=> 'mvc:admin',
				'pages'			=> array(
					array(
						'label'			=> 'users',
						'icon'			=> 'user',
						'route'			=> 'admin/default',
						'controller'	=> 'users',
						'resource'		=> 'mvc:admin',
						'pages'			=> array(
							array(
								'label'			=> 'add',
								'route'			=> 'admin/default',
								'controller'	=> 'users',
								'action' 		=> 'add',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'edit',
								'route'			=> 'admin/default',
								'controller'	=> 'users',
								'action' 		=> 'edit',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'delete',
								'route'			=> 'admin/default',
								'controller'	=> 'users',
								'action' 		=> 'delete',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
						),
					),
					array(
						'label'			=> 'clients',
						'icon'			=> 'building-o',
						'route'			=> 'admin/clientsedit',
						'action'		=> 'index',
						'resource'		=> 'mvc:admin',
						'pages'			=> array(
							array(
								'label'			=> 'add',
								'route'			=> 'admin/clientsedit',
								'action' 		=> 'add',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'edit',
								'route'			=> 'admin/clientsedit',
								'action' 		=> 'edit',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'delete',
								'route'			=> 'admin/clientsedit',
								'action' 		=> 'delete',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
						),
					),
					array(
						'label' 		=> 'permissions',
						'icon'			=> 'lock',
						'route'			=> 'admin/acledit',
						'action' 		=> 'index',
						'resource'		=> 'mvc:admin',
						'pages'			=> array(
							array(
								'label'			=> 'ACL',
								'icon'			=> 'asterisk',
								'route'			=> 'admin/acledit',
								'action' 		=> 'index',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'roles',
								'icon'			=> 'user',
								'route'			=> 'admin/acledit',
								'action' 		=> 'roles',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
								'pages' => array(
									array(
										'label' 		=> 'add',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'addrole',
									),
									array(
										'label' 		=> 'edit',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'editrole',
									),
									array(
										'label' 		=> 'delete',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'deleterole',
									),
								),
							),
							array(
								'label'			=> 'resources',
								'icon'			=> 'list-alt',
								'route'			=> 'admin/acledit',
								'action' 		=> 'resources',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
								'pages' => array(
									array(
										'label' 		=> 'add',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'addresource',
									),
									array(
										'label' 		=> 'edit',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'editresource',
									),
									array(
										'label' 		=> 'delete',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'deleteresource',
									),
								),
							),
						),
					),
					array(
						'label' 		=> 'settings',
						'icon'			=> 'cog',
						'route'			=> 'admin/settingsedit',
						'action' 		=> 'index',
						'resource'		=> 'mvc:user',
						'pages'			=> array(
							array(
								'label'			=> 'add',
								'route'			=> 'admin/settingsedit',
								'action' 		=> 'add',
								'resource'		=> 'mvc:user',
								'visible'		=> true,
							),
							array(
								'label'			=> 'edit',
								'route'			=> 'admin/settingsedit',
								'action' 		=> 'edit',
								'resource'		=> 'mvc:user',
								'visible'		=> true,
							),
							array(
								'label'			=> 'delete',
								'route'			=> 'admin/settingsedit',
								'action' 		=> 'delete',
								'resource'		=> 'mvc:user',
								'visible'		=> true,
							),
						),
					),
					array(
						'label'			=> 'system',
						'icon'			=> 'desktop',
						'route'			=> 'system',
						'action'		=> 'index',
						'resource'		=> 'mvc:admin',
						'pages'			=> array(
							array(
								'label'			=> 'info',
								'icon'			=> 'info-circle',
								'route'			=> 'system',
								'action' 		=> 'info',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'backup',
								'icon'			=> 'copy',
								'route'			=> 'system',
								'action' 		=> 'backup',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'setup',
								'icon'			=> 'wrench',
								'route'			=> 'setup',
								'action' 		=> 'index',
								//'resource'		=> 'mvc:admin',
								'visible'		=> true,
								'pages' => array(
									array(
										'label' 		=> 'install',
										'icon'			=> 'magic',
										'route' 		=> 'setup',
										//'resource'		=> 'mvc:admin',
										'action' 		=> 'install',
									),
									array(
										'label' 		=> 'update',
										'icon'			=> 'refresh',
										'route' 		=> 'setup',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'update',
									),
								),
							),
						),
					),
				),
			),
			array(
				'label'			=> 'help',
				'icon'			=> 'question-circle',
				'route'			=> 'application/default',
				'controller'	=> 'index',
				'action' 		=> 'notimplementedyet',
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
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
	'controllers' => array(
		'invokables' => array(
			'Application\Controller\Index' => 'Application\Controller\IndexController',
			'Application\Controller\System' => 'Application\Controller\SystemController',
			'Application\Controller\Setup' => 'Application\Controller\SetupController',
		),
	),
	'router' => array(
		'routes' => array(
			'home' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'	=> '/',
					'defaults' => array(
						'controller' => 'Application\Controller\Index',
						'action'	 => 'index',
					),
				),
			),
			// The following is a route to simplify getting started creating
			// new controllers and actions without needing to create a new
			// module. Simply drop new controllers in, and you can access them
			// using the path /application/:controller/:action
			'application' => array(
				'type'	=> 'Literal',
				'options' => array(
					'route'	=> '/application',
					'defaults' => array(
						'__NAMESPACE__' => 'Application\Controller',
						'controller'	=> 'index',
						'action'		=> 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'default' => array(
						'type'	=> 'Segment',
						'options' => array(
							'route'	=> '/[:controller[/:action]]',
							'constraints' => array(
								'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
								'action'	 => '[a-zA-Z][a-zA-Z0-9_-]*',
							),
							'defaults' => array(
						        'controller' => 'Application\Controller\Iindex',
							),
						),
					),
				),
			),
			'system' => array(
				'type'	=> 'Segment',
				'options' => array(
					'route'	=> '/system[/:action]',
					'constraints' => array(
						'action'	 => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
				        'controller' => 'Application\Controller\System',
					    'action'     => 'index',
					),
				),
			),
			'setup' => array(
				'type'	=> 'Segment',
				'options' => array(
					'route'	=> '/setup[/:action]',
					'constraints' => array(
						'action'	 => '[a-zA-Z][a-zA-Z0-9_-]*',
					),
					'defaults' => array(
				        'controller' => 'Application\Controller\Setup',
					    'action'     => 'index',
					),
				),
			),
		),
	),
	'service_manager' => array(
		'abstract_factories' => array(
			'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
			'Zend\Log\LoggerAbstractServiceFactory',
		),
		'factories' => array(
			'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            //'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
		),
		'aliases' => array(
			'translator' => 'MvcTranslator',
		),
	),
	'translator' => array(
		//'locale' => 'en_US', // deactivated because of SlmLocale module
		'translation_file_patterns' => array(
			array(
				'type'		=> 'gettext',
				'base_dir'	=> __DIR__ . '/../language',
				'pattern'	=> '%s.mo',
			),
		),
	),
	'view_manager' => array(
		'display_not_found_reason'	=> true,
		'display_exceptions'		=> true,
		'doctype'					=> 'HTML5',
		'not_found_template'		=> 'error/404',
		'exception_template'		=> 'error/index',
		'template_map' => array(
			'layout/layout'	=> __DIR__ . '/../view/layout/layout.phtml',
			//'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
			'error/404'		=> __DIR__ . '/../view/error/404.phtml',
			'error/index'	=> __DIR__ . '/../view/error/index.phtml',
            'layout/ajax'	=> __DIR__ . '/../view/layout/ajax.phtml',
            'layout/json'	=> __DIR__ . '/../view/layout/json.phtml',
            'layout/modal'	=> __DIR__ . '/../view/layout/modal.phtml',
            'layout/panel'	=> __DIR__ . '/../view/layout/panel.phtml',
		),
		'template_path_stack' => array(
			__DIR__ . '/../view',
			'zfc-user' => __DIR__ . '/../view',
		),
	),
		
	'navigation_helpers' => array (
	    'invokables' => array(
	    	// override or add a view helper
	        //'menu' => '\Application\View\Helper\Navigation\Menu',
	    ),
	),
		
    // Placeholder for console routes
	'console' => array(
		'router' => array(
			'routes' => array(
			),
		),
	),

		'navigation' => array(
				'default' => array(
						array(
								'label' => 'home',
								'icon'	=> 'home',
								'route' => 'home',
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

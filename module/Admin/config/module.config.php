<?php
return array(
	'settings' => array(
		'types' => array(
			'system'		=> 'system',
			'application'	=> 'application',
			'module'		=> 'module',
			'user'			=> 'user',
		)
	),
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Index'	=> 'Admin\Controller\IndexController',
            'Admin\Controller\Users'	=> 'Admin\Controller\UsersController',
            'Admin\Controller\Acl'		=> 'Admin\Controller\AclController',
            'Admin\Controller\Settings' => 'Admin\Controller\SettingsController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/admin',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:user_id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'user_id'    => '[0-9]*',
                            ),
                            'defaults' => array(
                            	'action'	 => 'index'
                            ),
                        ),
                    ),
                    'acledit' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/acl[/:action[/:acl_id]]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'acl_id'    => '[0-9]*',
                            ),
                            'defaults' => array(
                            	'controller' => 'Admin\Controller\Acl',
                            ),
                        ),
                    ),
                    'settingsedit' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/settings[/:action[/:set_id]]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'set_id'     => '[0-9]*',
                            ),
                            'defaults' => array(
                            	'controller' => 'Admin\Controller\Settings',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Admin' => __DIR__ . '/../view',
        ),
    ),
);

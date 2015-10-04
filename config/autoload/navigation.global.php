<?php
return array(
	'navigation' => array(
		'default' => array(
			array(
				'label' => 'Dashboard',
				'icon'	=> 'home',
				'route' => 'home',
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
				'label' => 'Account',
				'icon'	=> 'user',
				'route' => 'zfcuser',
				'pages'			=> array(
					array(
						'label'			=> 'Login',
						'route'			=> 'zfcuser/login',
						'resource'		=> 'mvc:nouser',
					),
					array(
						'label'			=> 'Registrierung',
						'route'			=> 'zfcuser/register',
						'resource'		=> 'mvc:nouser',
					),
					array(
						'label'			=> 'E-Mail ändern',
						'route'			=> 'zfcuser/changeemail',
						'resource'		=> 'mvc:user',
					),
					array(
						'label'			=> 'Passwort ändern',
						'route'			=> 'zfcuser/changepassword',
						'resource'		=> 'mvc:user',
					),
					array(
						'label'			=> 'Logout',
						'route'			=> 'zfcuser/logout',
						'resource'		=> 'mvc:user',
					),
					array(
						'label'			=> 'Benutzer-Bestätigung',
						'route'			=> 'userconfirmation',
						'visible'		=> false,
					),
					array(
						'label'			=> 'Benutzer-Aktivierung',
						'route'			=> 'useractivation',
						'resource'		=> 'mvc:admin',
						'visible'		=> false,
					),
				),
			),
			array(
				'label'			=> 'Admin',
				'icon'			=> 'cogs',
				'route'			=> 'admin',
				'resource'		=> 'mvc:admin',
				'pages'			=> array(
					array(
						'label'			=> 'Benutzer',
						'icon'			=> 'user',
						'route'			=> 'admin/default',
						'controller'	=> 'users',
						'resource'		=> 'mvc:admin',
						'pages'			=> array(
							array(
								'label'			=> 'Neu',
								'route'			=> 'admin/default',
								'controller'	=> 'users',
								'action' 		=> 'add',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'Bearbeiten',
								'route'			=> 'admin/default',
								'controller'	=> 'users',
								'action' 		=> 'edit',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'Entfernen',
								'route'			=> 'admin/default',
								'controller'	=> 'users',
								'action' 		=> 'delete',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
						),
					),
					array(
						'label' 		=> 'Rechte',
						'icon'			=> 'lock',
						'route'			=> 'admin/acledit',
						'action' 		=> 'index',
						'resource'		=> 'mvc:admin',
						'pages'			=> array(
							array(
								'label'			=> 'ACL',
								'route'			=> 'admin/acledit',
								'action' 		=> 'index',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'Rollen',
								'icon'			=> 'group',
								'route'			=> 'admin/acledit',
								'action' 		=> 'roles',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
								'pages' => array(
									array(
										'label' 		=> 'Rolle hinzufügen',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'addrole',
									),
									array(
										'label' 		=> 'Rolle ändern',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'editrole',
									),
									array(
										'label' 		=> 'Rolle entfernen',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'deleterole',
									),
								),
							),
							array(
								'label'			=> 'Resourcen',
								'icon'			=> 'list-ul',
								'route'			=> 'admin/acledit',
								'action' 		=> 'resources',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
								'pages' => array(
									array(
										'label' 		=> 'Resource hinzufügen',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'addresource',
									),
									array(
										'label' 		=> 'Resource ändern',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'editresource',
									),
									array(
										'label' 		=> 'Resource entfernen',
										'route' 		=> 'admin/acledit',
										'resource'		=> 'mvc:admin',
										'action' 		=> 'deleteresource',
									),
								),
							),
						),
					),
					array(
						'label' 		=> 'Einstellungen',
						'route'			=> 'admin/settingsedit',
						'action' 		=> 'index',
						'resource'		=> 'mvc:admin',
						'pages'			=> array(
							array(
								'label'			=> 'Neu',
								'route'			=> 'admin/settingsedit',
								'action' 		=> 'add',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'Bearbeiten',
								'route'			=> 'admin/settingsedit',
								'action' 		=> 'edit',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'Entfernen',
								'route'			=> 'admin/settingsedit',
								'action' 		=> 'delete',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
						),
					),
					array(
						'label'			=> 'System',
						'route'			=> 'system',
						'action'	    => 'index',
						'resource'		=> 'mvc:admin',
						'pages'			=> array(
							array(
								'label'			=> 'Systeminfo',
								'route'			=> 'system',
								'action' 		=> 'info',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'Backup',
								'route'			=> 'system',
								'action' 		=> 'backup',
								'resource'		=> 'mvc:admin',
								'visible'		=> true,
							),
							array(
								'label'			=> 'Setup',
								'route'			=> 'setup',
								'action' 		=> 'index',
								//'resource'		=> 'mvc:admin',
								'visible'		=> true,
								'pages' => array(
									array(
										'label' 		=> 'Installation',
										'route' 		=> 'setup',
										//'resource'		=> 'mvc:admin',
										'action' 		=> 'install',
									),
									array(
										'label' 		=> 'Update',
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
				'label'			=> 'Hilfe',
				'icon'			=> 'question-sign',
				'route'			=> 'application/default',
				'controller'	=> 'index',
				'action' 		=> 'notimplementedyet',
				'pages'			=> array(
					array(
						'label'			=> 'Hilfe',
						'route'			=> 'application/default',
						'controller'	=> 'index',
						'action' 		=> 'help',
					),
					array(
						'label'			=> 'Online-Support',
						'route'			=> 'application/default',
						'controller'	=> 'index',
						'action' 		=> 'support',
					),
					array(
						'label' 		=> 'Über MyApplication',
						'route'			=> 'application/default',
						'controller'	=> 'index',
						'action' 		=> 'about',
					),
				),
			),
		),
	),
);
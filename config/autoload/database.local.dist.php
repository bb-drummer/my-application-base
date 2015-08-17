<?php
return array(
    'db' => array( // global database setup
	        'driver'    => 'PdoMysql',
	        'hostname'  => 'localhost',
	        'database'  => 'dbname',
	        'username'  => 'dbuser',
	        'password'  => 'dbpassword',
    ),
	'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
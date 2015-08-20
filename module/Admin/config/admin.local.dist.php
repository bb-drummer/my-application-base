<?php
/**
 * Custom Admin Configuration Template
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
	/**
	 * registration redirect route to go upon successful user registration, 
	 * user's confirmation and admin's activation
	 **/
    'zfcuser_registration_redirect_route' => 'home', 
		
	/**
	 * user must confirm new registration via mail
	 **/
    'zfcuser_user_must_confirm' => true, 
		
	/**
	 * email adress to send confirmation mail from
	 **/
    'zfcuser_admin_from_email' => 'no-reply@example.com',
		
	/**
	 * email subject for confirmation mail
	 **/
    'zfcuser_confirm_subject' => "[myApplication] Benutzer-Bestätigung",
		
	/**
	 * admin must active new user via notification mail
	 **/
    'zfcuser_admin_must_activate' => true,
		
	/**
	 * admin's email adress to recieve activation mail
	 **/
    'zfcuser_admin_to_email' => 'useradmin@example.com',
		
	/**
	 * email subject for activation mail
	 **/
    'zfcuser_activate_subject' => "[myApplication] Benutzer-Aktivierung",
		
	/**
	 * SMTP configuration
	 */
	'smtp' => array(
		'name'              => 'example.com',
		'host'              => '127.0.0.1',
		'port'              => 587, // Notice port change for TLS is 587
		'connection_class'  => 'plain',
		'connection_config' => array(
			'username' => 'user',
			'password' => 'pass',
		),
	),
);

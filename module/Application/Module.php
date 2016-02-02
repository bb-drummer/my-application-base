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

namespace Application;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

// navigation
use Zend\View\HelperPluginManager;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

// service locator
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;


class Module implements AutoloaderProviderInterface, ServiceLocatorAwareInterface
{
	protected $Acl;
	protected $AclTable;
	protected $AclroleTable;
	protected $AclresourceTable;
	protected $serviceLocator;

	public function init(ModuleManager $oModuleManager)
	{
		// init layout, leave out "__NAMESPACE__" parameter to set layout for all modules
		$oModuleManager
			->getEventManager()
			->getSharedManager()
			->attach(
				__NAMESPACE__, 
				'dispatch', 
				('Application\Module::initLayout') 
			)
		;

	}	
	
	public function onBootstrap(MvcEvent $e)
	{
		$eventManager		= $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		$application = $e->getApplication();
		/** @var $serviceManager \Zend\ServiceManager\ServiceManager */
		$serviceManager = $application->getServiceManager();

		// set (form) validator locale
		$translator = $serviceManager->get('translator');
		\Zend\Validator\AbstractValidator::setDefaultTranslator($translator, 'default');
		
		// override or add a view helper
		// /** @var $pm \Zend\View\Helper\Navigation\PluginManager */
		// $pm = $serviceManager->get('ViewHelperManager')->get('Navigation')->getPluginManager();
		// $pm->setInvokableClass('menu', '\Application\View\Helper\Navigation\Menu');
		
	}

	public function getApplicationConfig()
	{
		$applicationGlobalConfigFile	= __DIR__ . '/../../config/application.config.php';
		$genericGlobalConfigFile	= __DIR__ . '/../../config/autoload/global.php';
		
		$localConfigs = array();
		$files = scandir(__DIR__ . '/../../config/autoload/');
		
		foreach ($files as $key => $filename) {
			$filepath = __DIR__ . '/../../config/autoload/' . $filename ;
			if ( (strpos($filename, 'local.php') !== false) && is_readable($filepath) ) { 
				array_merge_recursive($localConfigs, include $filepath);
			}
		}
		
		// load setting from DB...
		
		return array_merge_recursive(
			( is_readable($applicationGlobalConfigFile) ? include $applicationGlobalConfigFile : array() ),
			( is_readable($genericGlobalConfigFile) ? include $genericGlobalConfigFile : array() ),
			$localConfigs
		);
	}

	public function loadConfigFromDB ()
	{
		
	}

	public function getConfig()
	{
		$moduleGlobalConfigFile = __DIR__ . '/config/module.config.php';
		$moduleLocalConfigFile	= __DIR__ . '/../../config/autoload/vhosts.local.php';
		
		return array_merge_recursive(
			( is_readable($moduleGlobalConfigFile) ? include $moduleGlobalConfigFile : array() ),
			( is_readable($moduleLocalConfigFile) ? include $moduleLocalConfigFile : array() ),
			$this->getApplicationConfig()
		);
	}

	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
				),
			),
		);
	}
	
	public function getViewHelperConfig()
	{
		return array(
			'factories' => array(
				'navigation' => function(HelperPluginManager $pm) {
					$this->setServiceLocator($pm->getServiceLocator());
					$acl = \Admin\Module::initACL($pm->getServiceLocator());
					
					$navigation = $pm->get('Zend\View\Helper\Navigation');
					$navigation->setAcl($acl);
					
					$oAuth = $pm->getServiceLocator()->get('zfcuser_auth_service');
					if ( $oAuth->hasIdentity() ) {
						$oUser = $oAuth->getIdentity();
						$navigation->setRole( $oUser->getAclrole() );
					} else {
						$navigation->setRole('public');
					}
					
					return $navigation;
				},
			)
		);
	}
	
	/**
	 * Set serviceManager instance
	 *
	 * @param	ServiceLocatorInterface $serviceLocator
	 * @return void
	 */
	public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
	{
		$this->serviceLocator = $serviceLocator;
		return $this;
	}

	/**
	 * Retrieve serviceManager instance
	 *
	 * @return ServiceLocatorInterface
	 */
	public function getServiceLocator()
	{
		if (!$this->serviceLocator) {
			$this->serviceLocator = new \Zend\Di\ServiceLocator();
		}
		return $this->serviceLocator;
	}
	
	public function getServiceConfig()
	{
		return array(
			'factories' => array(
			),
		);
	}
	
	/**
	 * switches the main response layout according to request headers
	 * 
	 * @param	$oEvent	\Zend\Mvc\Event
	 * @return	void
	 */
	public static function initLayout ( $oEvent )
	{
		$oController = $oEvent->getTarget();
		$sAccept = $oController->getRequest()->getHeaders()->get('Accept')->toString();
		echo '<!-- '.print_r($sAccept, true).' -->';
		if ( $oController->getRequest()->isXmlHttpRequest() ) {
			if ( strpos($sAccept, 'text/html') !== false ) {
				$sLayout = $oController->getRequest()->getHeaders()->get('X-layout')->toString(); 
				//echo '<!-- '.print_r($sLayout, true).' -->';
				if ( strpos($sLayout, 'modal') !== false ) {
					$oController->layout('layout/modal');
				} else if ( strpos($sLayout, 'panel') !== false ) {
					$oController->layout('layout/panel');
				} else {
					$oController->layout('layout/ajax');
				}
			} else {
				$oController->layout('layout/json');
			}
		} else {
			$oController->layout('layout/layout');
		}
	}

}

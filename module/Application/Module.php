<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link	  http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Application\Entity\User;

// navigation
use Zend\View\HelperPluginManager;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

// service locator
use Zend\ServiceManager\ServiceLocatorInterface;


class Module // implements AutoloaderProviderInterface //, ServiceLocatorAwareInterface
{
	protected $Acl;
	protected $AclTable;
	protected $AclroleTable;
	protected $AclresourceTable;
	protected $serviceLocator;

	public function onBootstrap(MvcEvent $e)
	{
		$eventManager		= $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		$application = $e->getApplication();
		/** @var $serviceManager \Zend\ServiceManager\ServiceManager */
		$serviceManager = $application->getServiceManager();

		// override or add a view helper
		// /** @var $pm \Zend\View\Helper\Navigation\PluginManager */
		// $pm = $serviceManager->get('ViewHelperManager')->get('Navigation')->getPluginManager();
		// $pm->setInvokableClass('menu', '\Application\View\Helper\Navigation\Menu');
		
	}

	public function getApplicationConfig()
	{
		$applicationGlobalConfigFile  = __DIR__ . '/../../config/application.config.php';
		$genericGlobalConfigFile  = __DIR__ . '/../../config/autoload/global.php';
		
		$localConfigs = array();
		$files = scandir(__DIR__ . '/../../config/autoload/');
		
		foreach ($files as $key => $filename) {
			$filepath = __DIR__ . '/../../config/autoload/' . $filename ;
			if ( (strpos($filename, 'local.php') !== false) && is_readable($filepath) ) { 
				array_merge_recursive($localConfigs, include $filepath);
			}
		}
		return array_merge_recursive(
			( is_readable($applicationGlobalConfigFile) ? include $applicationGlobalConfigFile : array() ),
			( is_readable($genericGlobalConfigFile) ? include $genericGlobalConfigFile : array() ),
			$localConfigs
		);
	}

	public function getConfig()
	{
		$moduleGlobalConfigFile = __DIR__ . '/config/module.config.php';
		$moduleLocalConfigFile  = __DIR__ . '/../../config/autoload/vhosts.local.php';
		
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
					$acl = $this->getAcl(); 
					
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
				'bootstrap' => function(HelperPluginManager $pm) {
					$this->setServiceLocator($pm->getServiceLocator());
					$acl = $this->getAcl(); 
					
					$bootstrap = $pm->get('Application\View\Helper\Bootstrap');
					$bootstrap->setAcl($acl);
					
					$oAuth = $pm->getServiceLocator()->get('zfcuser_auth_service');
					if ( $oAuth->hasIdentity() ) {
						$oUser = $oAuth->getIdentity();
						$bootstrap->setRole( $oUser->getAclrole() );
					} else {
						$bootstrap->setRole('public');
					}
					
					return $bootstrap;
				},
				'components' => function(HelperPluginManager $pm) {
					$this->setServiceLocator($pm->getServiceLocator());
					$acl = $this->getAcl(); 
					
					$components = $pm->get('Application\View\Helper\Components');
					$components->setAcl($acl);
					
					$oAuth = $pm->getServiceLocator()->get('zfcuser_auth_service');
					if ( $oAuth->hasIdentity() ) {
						$oUser = $oAuth->getIdentity();
						$components->setRole( $oUser->getAclrole() );
					} else {
						$components->setRole('public');
					}
					
					return $components;
				}
			)
		);
	}
	
	/**
	 * Set serviceManager instance
	 *
	 * @param  ServiceLocatorInterface $serviceLocator
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
	
	// table getters
	
	public function getAcl()
	{
		$sm = $this->getServiceLocator();
		$acl = new Acl();
		$oAcls = $sm->get('\Admin\Model\AclTable');
		$oRoles = $this->getAclroleTable();
		$aRoles = $oRoles->fetchAll()->toArray();
		foreach ($aRoles as $key => $role) {
			$acl->addRole(new GenericRole($role['roleslug']));
		}
		$oResources = $sm->get('\Admin\Model\AclresourceTable');
		$aResources = $oResources->fetchAll()->toArray();
		foreach ($aResources as $key => $resource) {
			$acl->addResource(new GenericResource($resource['resourceslug']));
		}

		foreach ($aRoles as $key => $role) {
			foreach ($aResources as $key => $resource) {
				$oAcl = $oAcls->getAclByRoleResource($role['aclroles_id'], $resource['aclresources_id']);
				if ( $oAcl && !empty($oAcl->state) ) {
					if ( ($oAcl->state == 'allow') ) {
						$acl->allow(
							$role['roleslug'], 
							array($resource['resourceslug'])
						);
					} else if ( ($oAcl->state == 'deny') ) {
						$acl->deny(
							$role['roleslug'], 
							array($resource['resourceslug'])
						);
					}
				}
			}
		}
		
		// whatever happens before, allow all actions to 'admin' and 'nouser' actions to public viewers
		$acl->allow('admin', null);
		$acl->deny('admin', array(
			'mvc:nouser',
		));
		$acl->allow('public', array(
			'mvc:nouser',
		));
		
		return $acl;
	}

	public function getAclTable()
	{
		if (!$this->AclTable) {
			$sm = $this->getServiceLocator();
			$this->AclTable = $sm->get('\Admin\Model\AclTable');
		}
		return $this->AclTable;
	}

	public function getAclroleTable()
	{
		if (!$this->AclroleTable) {
			$sm = $this->getServiceLocator();
			$this->AclroleTable = $sm->get('\Admin\Model\AclroleTable');
		}
		return $this->AclroleTable;
	}

	public function getAclresourceTable()
	{
		if (!$this->AclresourceTable) {
			$sm = $this->getServiceLocator();
			$this->AclresourceTable = $sm->get('\Admin\Model\AclresourceTable');
		}
		return $this->AclresourceTable;
	}
	
}

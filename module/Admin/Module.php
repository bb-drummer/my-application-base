<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link	  http://github.com/zendframework/Admin for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;
use Admin\Model\User;
use Admin\Model\UserTable;
use Admin\Model\Settings;
use Admin\Model\SettingsTable;
use Admin\Model\Acl;
use Admin\Model\AclTable;
use Admin\Model\Aclrole;
use Admin\Model\AclroleTable;
use Admin\Model\Aclresource;
use Admin\Model\AclresourceTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\Controller\Action;
use Admin\Controller\RedirectCallback;
use Admin\Controller\ZfcuserController;


class Module implements AutoloaderProviderInterface, ServiceLocatorAwareInterface
{
	
	protected $serviceLocator;
	
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\ClassMapAutoloader' => array(
				__DIR__ . '/autoload_classmap.php',
			),
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
			// if we're in a namespace deeper than one level we need to fix the \ in the path
					__NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
				),
			),
		);
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	public function onBootstrap(MvcEvent $e)
	{
		$eventManager		= $e->getApplication()->getEventManager();
		$moduleRouteListener = new ModuleRouteListener();
		$moduleRouteListener->attach($eventManager);

		$this->initAcl($e);
		$e->getApplication()->getEventManager()->attach('dispatch', array($this, 'checkAcl'));
	}
	
	public function initAcl(MvcEvent $e) {
		$sm = $e->getApplication()->getServiceManager();
		$acl = new ZendAcl();
		$oAcls = $sm->get('\Admin\Model\AclTable');
		$oRoles = $sm->get('Admin\Model\AclroleTable');
		$oResources = $sm->get('\Admin\Model\AclresourceTable');
		
		$aRoles = $oRoles->fetchAll()->toArray();
		foreach ($aRoles as $key => $role) {
			$acl->addRole(new GenericRole($role['roleslug']));
		}
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
		
		// whatever happens before, allow all actions to 'admin'
		$acl->allow('admin', null);
		$acl->deny('admin', array(
			'mvc:nouser',
		));
		
		$e->getViewModel()->acl = $acl;
	}
	
	public function checkAcl(MvcEvent $e) {
		$oAcl = $e->getViewModel()->acl;
		$oSM = $e->getApplication()->getServiceManager();
		
		$sAclRole = 'public';
		$oAuth = $oSM->get('zfcuser_auth_service');
		if ( $oAuth->hasIdentity() ) {
			$oUser = $oAuth->getIdentity();
			$sAclRole = $oUser->getAclrole();
		}

		$oNavigation = $oSM->get('navigation');
		$activePage = $oNavigation->findBy('active', 1);
		if ($activePage) {
			$sAclResource = $activePage->getResource();
			if (!empty($sAclResource) && $oAcl->hasResource($sAclResource)) {
				if ( !$oAcl->isAllowed($sAclRole, $sAclResource) ) {
					$response = $e->getResponse();
					//location to page or what ever
					$response->getHeaders()->addHeaderLine('Location', $e->getRequest()->getBaseUrl() . '/user/login?redirect=' . $e->getRequest()->getRequestUri() );
					$response->setStatusCode(301);
			
				}
			}
		}
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
	
    public function getControllerConfig()
    {
        return array(
            'factories' => array(
                'zfcuser' => function($controllerManager) {
                        /* @var ControllerManager $controllerManager*/
                        $serviceManager = $controllerManager->getServiceLocator();

                        /* @var RedirectCallback $redirectCallback */
                        $redirectCallback = $serviceManager->get('zfcuser_redirect_callback');

                        /* @var UserController $controller */
                        $controller = new ZfcuserController($redirectCallback);

                        return $controller;
                    },
            ),
        );
    }

	public function getServiceConfig()
	{
		return array(
			'factories' => array(
				'Admin\Model\UserTable' =>  function($sm) {
					$tableGateway = $sm->get('AdminUserTableGateway');
					$table = new UserTable($tableGateway);
					return $table;
				},
				'Admin\Model\SettingsTable' =>  function($sm) {
					$tableGateway = $sm->get('AdminSettingsTableGateway');
					$table = new SettingsTable($tableGateway);
					return $table;
				},
				
				'Admin\Model\AclTable' =>  function($sm) {
					$tableGateway = $sm->get('AdminAclTableGateway');
					$table = new AclTable($tableGateway);
					return $table;
				},
				'Admin\Model\AclroleTable' =>  function($sm) {
					$tableGateway = $sm->get('AdminAclroleTableGateway');
					$table = new AclroleTable($tableGateway);
					return $table;
				},
				'Admin\Model\AclresourceTable' =>  function($sm) {
					$tableGateway = $sm->get('AdminAclresourceTableGateway');
					$table = new AclresourceTable($tableGateway);
					return $table;
				},
				
				'AdminUserTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new User());
					return new TableGateway('user', $dbAdapter, null, $resultSetPrototype);
				},
				'AdminSettingsTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Settings());
					return new TableGateway('settings', $dbAdapter, null, $resultSetPrototype);
				},
				
				'AdminAclTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Acl());
					return new TableGateway('acl', $dbAdapter, null, $resultSetPrototype);
				},
				'AdminAclroleTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Aclrole());
					return new TableGateway('aclrole', $dbAdapter, null, $resultSetPrototype);
				},
				'AdminAclresourceTableGateway' => function ($sm) {
					$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
					$resultSetPrototype = new ResultSet();
					$resultSetPrototype->setArrayObjectPrototype(new Aclresource());
					return new TableGateway('aclresource', $dbAdapter, null, $resultSetPrototype);
				},

                'zfcuser_redirect_callback' => function ($sm) {
                    /* @var RouteInterface $router */
                    $router = $sm->get('router');
                    
					//echo '<pre>'.print_r($router, true).'</pre>'; die();
                    /* @var Application $application */
                    $application = $sm->get('Application');

                    /* @var ModuleOptions $options */
                    $options = $sm->get('zfcuser_module_options');

                    return new RedirectCallback($application, $router, $options);
				},
            ),
		);
	}
}

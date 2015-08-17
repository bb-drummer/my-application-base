<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\HelperPluginManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\DispatchableInterface as Dispatchable;
use Zend\Stdlib\RequestInterface as Request;
use Zend\Stdlib\ResponseInterface as Response;
use ZfcUser\View\Helper\ZfcUserIdentity;
use ZfcUser\Controller\Plugin\ZfcUserAuthentication;

/**
 * BaseController
 *
 * @author
 *
 * @version
 *
 */
class BaseActionController extends AbstractActionController implements Dispatchable, ServiceLocatorAwareInterface {
	
    protected $services;

    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->services = $serviceLocator;
    }

    public function getServiceLocator()
    {
        return $this->services;
    }

    /**
     * 
     * @return \Zend\Permissions\Acl\Acl
     */
    public function getAcl() {
    	return $this->getServiceLocator()->get('\Admin\Model\AclService');
    }

    /**
     * @return ZfcUserAuthentication
     */
    public function getUser() {

    	$oAuth = $this->getServiceLocator()->get('zfcuser_auth_service');
    	if ( $oAuth->hasIdentity() ) {
    		return $oAuth->getIdentity();
    	}
    	return null;
    }
    
    /**
     * @return boolean
     */
    public function isAdminUser() {
    	$oUser = $this->getUser();
        $sAclRole = $oUser->getAclrole();
        return ($sAclRole == 'admin');
    }
    
    
    
}
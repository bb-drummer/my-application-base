<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\DispatchableInterface as Dispatchable;
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
	
    protected $translator;

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
    
    
	/**
	 * @return \Zend\I18n\Translator\Translator
	 */
	public function getTranslator() {
		if (!$this->translator) {
			$this->setTranslator($this->getServiceLocator()->get('translator'));
		}
		return $this->translator;
	}

	/**
	 * @param field_type $translator
	 */
	public function setTranslator($translator) {
		$this->translator = $translator;
		return ($this);
	}

	/**
	 * @param string $translator
	 * @param string $textdomain
	 * @param string $locale
	 */
	public function translate($message, $textdomain = 'default', $locale = null) {
		return ( $this->getTranslator()->translate($message, $textdomain, $locale) );
	}
    
    
    
}
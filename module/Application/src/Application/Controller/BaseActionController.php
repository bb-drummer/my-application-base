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

namespace Application\Controller;

use Zend\Mvc\MvcEvent;
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
    
    protected $actionTitles = array();
    

    public function onDispatch(MvcEvent $e)
    {
    	$action = $e->getRouteMatch()->getParam('action'); // $this->get->getParam('action', 'index');
    	$this->layout()->setVariable("title", $this->getActionTitle($action));
    	$result = parent::onDispatch($e);
    	return $result;
    }

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
    
    /**
     * fetch request parameters
     */
    public function getTemplateVars ( $vars = array() ) {
		$result = (array_merge( 
			$this->params()->fromRoute(), 
			$this->params()->fromPost(),
			array(
				"isXHR" => $this->getRequest()->isXmlHttpRequest()
			)
		));
		if (is_array($vars)) {
			$result = (array_merge(
				$result, $vars
			));
		}
		return ($result);
    }
    
	/**
	 * @return the $actionTitles
	 */
	public function getActionTitles() {
		return $this->actionTitles ;
	}

	/**
	 * @param array $actionTitles
	 */
	public function setActionTitles($actionTitles = array()) {
		$this->actionTitles = $actionTitles;
		return $this;
	}

	/**
	 * @return the $actionTitles
	 */
	public function getActionTitle($action) {
		return (isset($this->actionTitles[$action]) ? $this->actionTitles[$action] : '');
	}
	
	/**
	 * @param string $action
	 * @param string $title
	 */
	public function setActionTitle($action, $title) {
		$this->actionTitles[$action] = $title;
		return $this;
	}
    
    
}
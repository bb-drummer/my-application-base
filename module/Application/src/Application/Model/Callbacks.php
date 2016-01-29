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

namespace Application\Model;

use Zend\Permissions\Acl\Acl as ZendAcl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

class Callbacks 
{
	
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

	/**
	 * load and initialize (global) ACL
	 * 
	 * @param	$oServiceManager	\Zend\ServiceManager\ServiceManager
	 * @return	\Zend\Permissions\Acl\Acl
	 */
	public static function initACL ( $oServiceManager )
	{
		$oACL = new ZendAcl();
		$oAcls = $oServiceManager->get('\Admin\Model\AclTable');
		$oRoles = $oServiceManager->get('Admin\Model\AclroleTable');
		$oResources = $oServiceManager->get('\Admin\Model\AclresourceTable');
		
		$aRoles = $oRoles->fetchAll()->toArray();
		foreach ($aRoles as $key => $role) {
			$oACL->addRole(new GenericRole($role['roleslug']));
		}
		$aResources = $oResources->fetchAll()->toArray();
		foreach ($aResources as $key => $resource) {
			$oACL->addResource(new GenericResource($resource['resourceslug']));
		}
		
		foreach ($aRoles as $key => $role) {
			foreach ($aResources as $key => $resource) {
				$oAclItem = $oAcls->getAclByRoleResource($role['aclroles_id'], $resource['aclresources_id']);
				if ( $oAclItem && !empty($oAclItem->state) ) {
					if ( ($oAclItem->state == 'allow') ) {
						$oACL->allow(
							$role['roleslug'],
							array($resource['resourceslug'])
						);
					} else if ( ($oAclItem->state == 'deny') ) {
						$oACL->deny(
							$role['roleslug'],
							array($resource['resourceslug'])
						);
					}
				}
			}
		}
		
		// whatever happens before, allow all actions to 'admin'
		$oACL->allow('admin', null);
		$oACL->deny('admin', array(
				'mvc:nouser',
		));
		
		return ($oACL);
	}
	
}
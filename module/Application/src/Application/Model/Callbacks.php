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

class Callbacks 
{
    
	/**
	 * switches the main response layout according to request headers
	 * 
	 * @param \Zend\Mvc\Event $oEvent
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
}

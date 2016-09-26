<?php
namespace ApplicationTest\Framework;

use PHPUnit_Framework_TestCase;

/**
 * [MyApplication] Applicarion module tests
 * 
 * @package   [MyApplication]
 * @package   BB's Zend Framework 2 Components
 * @package   AdminModule
 * @author    Björn Bartels <coding@bjoernbartels.earth>
 * @link      https://gitlab.bjoernbartels.earth/groups/zf2
 * @license   http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 * @copyright copyright (c) 2016 Björn Bartels <coding@bjoernbartels.earth>
 *
 * @coversNothing
 */
class TestCase extends PHPUnit_Framework_TestCase
{

    public static $locator;

    public static function setLocator($locator)
    {
        self::$locator = $locator;
    }

    public function getLocator()
    {
        return self::$locator;
    }
    
    public function testFoo() 
    {
        $this->assertTrue(true);
    }
    

    //
    // data/mock helpers
    //
    
    
    /**
     *  set mock for ZfcUserAuthentication
     */
    private function setZfcUserValidAuthMock() 
    {
        $mockAuth = $this->createMock('ZfcUser\Entity\UserInterface');
        
        $ZfcUserMock = $this->createMock('Admin\Entity\User');  
        
        $ZfcUserMock->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('1'));
        
        $ZfcUserMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue('valid-password-reset-token'));
        
        $authMock = $this->createMock('ZfcUser\Controller\Plugin\ZfcUserAuthentication');
        
        $authMock->expects($this->any())
            ->method('hasIdentity')
            -> will($this->returnValue(true));  
        
        $authMock->expects($this->any())
            ->method('getIdentity')
            ->will($this->returnValue($ZfcUserMock));
        
        $this->getController()->getPluginManager()
            ->setService('zfcUserAuthentication', $authMock);
    }
    
    /**
     *  set mock for ZfcUserAuthentication
     */
    private function setZfcUserNoAuthMock() 
    {
        $mockAuth = $this->createMock('ZfcUser\Entity\UserInterface');
        
        $ZfcUserMock = $this->createMock('Admin\Entity\User');  

        $ZfcUserMock->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(0));
        
        $ZfcUserMock->expects($this->any())
            ->method('getToken')
            ->will($this->returnValue('valid-password-reset-token'));
        
        $authMock = $this->createMock('ZfcUser\Controller\Plugin\ZfcUserAuthentication');
        
        $authMock->expects($this->any())
            ->method('hasIdentity')
            -> will($this->returnValue(false));  
        
        $authMock->expects($this->any())
            ->method('getIdentity')
            ->will($this->returnValue($ZfcUserMock));
        
        $this->getController()->getPluginManager()
            ->setService('zfcUserAuthentication', $authMock);
    }

}

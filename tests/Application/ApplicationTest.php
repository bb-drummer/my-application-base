<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Admin for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace ApplicationTest;

use PHPUnit_Framework_TestCase;

class ApplicationTest  extends PHPUnit_Framework_TestCase
{

	public function testThisIsTrue()
	{
		$this->assertTrue(true, 'this is "true"... ^^' );
	}

	public function testThisIsFalse()
	{
		$this->assertFalse(false, 'this is "false"... ^^' );
	}
	
    public static $locator;

    public static function setLocator($locator)
    {
        self::$locator = $locator;
    }

    public function getLocator()
    {
        return self::$locator;
    }
}

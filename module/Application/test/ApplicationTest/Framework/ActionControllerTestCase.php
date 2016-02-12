<?php
namespace ApplicationTest\Framework;

use \ApplicationTest\Bootstrap as AppTestsBootstrap,
	Zend\Http\Request,
	Zend\Http\Response,
	Zend\Mvc\MvcEvent,
	Zend\Mvc\Router\RouteMatch,
	Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

/**
 * @coversNothing
 */
class ActionControllerTestCase extends AbstractHttpControllerTestCase
{

	/**
	 * dummy test
	 * @coversNothing
	 */
	public function testTest() {
		$this->assertTrue(true);
	}
	
	//
	// basic test setup
	//
	
	/**
	 * @var \Zend\Mvc\Controller
	 */
	protected $controller;
	
	/**
	 * @var \Zend\Http\Request
	 */
	protected $request;
	
	/**
	 * @var \Zend\Http\Response
	 */
	protected $response;
	
	/**
	 * @var \Zend\Mvc\Router\RouteMatch
	 */
	protected $routeMatch;
	
	/**
	 * @var \Zend\Mvc\MvcEvent
	 */
	protected $event;
 
	/**
	 * Sets up the fixture, for example, opens a network connection.
	 * This method is called before a test is executed.
	 */
	public function setUp()
	{
		$this->setApplicationConfig( include 'config/application.config.php' );
		parent::setUp();
		
		if (method_exists($this, 'setupController')) {
			$this->setupController();
		}
		
	}
	
	public function setupController() {
	}
	
	/**
	 * Tears down the fixture, for example, closes a network connection.
	 * This method is called after a test is executed.
	 */
	protected function tearDown()
	{
		// parent::tearDown();
	}
	
	/**
	 * @return \Zend\Mvc\Controller $controller
	 */
	public function getController() {
		if (null === $this->controller) {
			throw new \Exception('controller is not of an instance of "Zend\Mvc\Controller"');
		}
		return $this->controller;
	}

	/**
	 * @param \Zend\Mvc\Controller $controller
	 */
	public function setController($controller) {
		if ($controller instanceof \Zend\Mvc\Controller\AbstractController) {
			$this->controller = $controller;
			return ($this);
		} else {
			throw new \Exception('controller to set must be of instance of "Zend\Mvc\Controller"');
		}
	}

	/**
	 * @return \Zend\Http\Request $request
	 */
	public function getRequest() {
		if (null === $this->request) {
			$this->setRequest(new Request());
		}
		return $this->request;
	}

	/**
	 * @param \Zend\Http\Request $request
	 */
	public function setRequest($request) {
		$this->request = $request;
		return ($this);
	}

	/**
	 * @return \Zend\Http\Response $response
	 */
	public function getResponse() {
		if (null === $this->response) {
			$this->setResponse(new Response());
		}
		return $this->response;
	}

	/**
	 * @param \Zend\Http\Response $response
	 */
	public function setResponse($response) {
		$this->response = $response;
		return ($this);
	}

	/**
	 * @return \Zend\Mvc\Router\RouteMatch $routeMatch
	 */
	public function getRouteMatch() {
		if (null === $this->routeMatch) {
			throw new \Exception('no route-match of instance of "Zend\Mvc\Router\RouteMatch" is set');
		}
		return $this->routeMatch;
	}

	/**
	 * @param \Zend\Mvc\Router\RouteMatch $routeMatch
	 */
	public function setRouteMatch($routeMatch) {
		if ($routeMatch instanceof \Zend\Mvc\Router\RouteMatch) {
			$this->routeMatch = $routeMatch;
			return ($this);
		} else {
			throw new \Exception('route-match to set must be of instance of "Zend\Mvc\Router\RouteMatch"');
		}
		$this->routeMatch = $routeMatch;
		return ($this);
	}

	/**
	 * @return \Zend\Mvc\MvcEvent $event
	 */
	public function getEvent() {
		if (null === $this->event) {
			$this->setEvent(new MvcEvent());
		}
		return $this->event;
	}

	/**
	 * @param \Zend\Mvc\MvcEvent $event
	 */
	public function setEvent($event) {
		$this->event = $event;
		return ($this);
	}

}

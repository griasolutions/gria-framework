<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class ErrorControllerTest extends \PHPUnit_Framework_TestCase
{

	use RequestAwareTestTrait {
		setUp as requestTraitSetup;
	}

	private $_controller;

	public function setUp()
	{
		$this->requestTraitSetup();
		$this->_request->expects($this->any())
			->method('getUri')
			->will($this->returnValue('/test'));
		$this->_controller = new Controller\ErrorController($this->getRequest(), $this->getConfig());
	}

	public function testSetGetException()
	{
		$exception = new \Exception('test', 500);
		$this->getController()->setException($exception);
		$this->assertEquals($exception, $this->getController()->getException());
	}

	public function testRoute()
	{
		$this->getController()->route();
		$this->assertNotEquals(200, $this->getController()->getView()->get('statusCode'));
	}

	public function getController()
	{
		return $this->_controller;
	}

} 
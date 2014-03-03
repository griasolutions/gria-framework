<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class ErrorControllerTest extends ControllerTestAbstract
{

	private $_controller;

	public function setUp()
	{
		parent::setUp();
		$this->getRequest()->expects($this->any())
			->method('getUri')
			->will($this->returnValue('/test'));
		$this->setController(new Controller\ErrorController($this->getRequest(), $this->getHelperManager(), $this->getConfig()));
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
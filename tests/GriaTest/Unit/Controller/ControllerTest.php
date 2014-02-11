<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class ControllerTest extends \PHPUnit_Framework_TestCase
{

	use RequestAwareTestTrait {
		setUp as requestTraitSetup;
	}

	private $_controller;

	public function setUp()
	{
		$this->requestTraitSetup();
		$this->_controller = new Controller\Controller($this->getRequest(), $this->getConfig());
	}

	public function testGetRequest()
	{
		$this->assertInstanceOf('\Gria\Controller\Request', $this->getController()->getRequest());
	}

	public function testGetResponse()
	{
		$this->assertInstanceOf('\Gria\Controller\Response', $this->getController()->getResponse());
	}

	public function testGetView()
	{
		$this->assertInstanceOf('\Gria\View\View', $this->getController()->getView());
	}

	/**
	 * @expectedException \BadMethodCallException
	 */
	public function testRoute()
	{
		$this->getRequest()->expects($this->any())
			->method('getActionName')
			->will($this->returnValue('test'));
		$controller = new Controller\Controller($this->getRequest(), $this->getConfig());
		$controller->route();
	}

	/**
	 * @expectedException \Exception
	 */
	public function testRender()
	{
		$this->getRequest()->expects($this->any())
			->method('getActionName')
			->will($this->returnValue('index'));
		$controller = new Controller\Controller($this->getRequest(), $this->getConfig());
		$controller->route();
		$controller->render();
		$this->assertEquals('controller', $controller->getView()->getSourcePath());
	}

	public function getController()
	{
		return $this->_controller;
	}

} 
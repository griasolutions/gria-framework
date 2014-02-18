<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class ControllerTest extends \GriaTest\Unit\Controller\ControllerTestAbstract
{

	public function setUp()
	{
        parent::setUp();
        $this->getMock('\IniParser', array('parse'))
            ->expects($this->any())
            ->method('parse')
            ->will($this->returnValue(array(
                        'name' => 'you'
                    )));
		$this->setController(new Controller\Controller($this->getRequest(), $this->getHelperManager(), $this->getConfig()));
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
		$controller = new Controller\Controller($this->getRequest(), $this->getHelperManager(), $this->getConfig());
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
		$controller = new Controller\Controller($this->getRequest(), $this->getHelperManager(), $this->getConfig());
		$controller->route();
		$controller->render();
		$this->assertEquals('controller', $controller->getView()->getSourcePath());
	}


} 
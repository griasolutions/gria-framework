<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class ControllerTest extends \PHPUnit_Framework_TestCase
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
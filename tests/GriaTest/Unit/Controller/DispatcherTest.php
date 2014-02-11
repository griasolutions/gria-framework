<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{

	use RequestAwareTestTrait;

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testGetErrorController()
	{
		$this->getRequest()->expects($this->any())
			->method('getControllerName')
			->will($this->returnValue('stupidness'));
		$dispatcher = new Controller\Dispatcher($this->getRequest(), $this->getConfig());
		$dispatcher->getController();
	}

	public function testGetValidController()
	{
		$this->getRequest()->expects($this->any())
			->method('getControllerName')
			->will($this->returnValue('dashboard'));
		$dispatcher = new Controller\Dispatcher($this->getRequest(), $this->getConfig());
		$this->assertInstanceOf('\Application\Controller\Dashboard', $dispatcher->getController());
	}

} 
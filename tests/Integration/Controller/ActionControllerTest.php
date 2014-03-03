<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;
use \Gria\Helper;

class ActionControllerTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Gria\Controller\ActionController */
    private $_controller;

	public function setUp()
	{
        parent::setUp();
        $request = $this->getMock('\Gria\Controller\Request', array('getServer'));
        $request->expects($this->any())
            ->method('getServer')
            ->will($this->returnValue('localhost'));
        $config = $this->getMock('\Gria\Config\Config');
		$helperManager = new Helper\Manager($config);
        $this->_controller = new Controller\ActionController($request, $config, $helperManager);
	}

    public function testGetName()
    {
        $this->assertEquals('gria\controller\actioncontroller', $this->getController()->getName());
    }

    /**
     * @expectedException \Gria\Controller\InvalidActionException
     */
    public function testInvalidDispatch()
    {
        $controller = $this->getController();
        $controller->dispatch('invalid');
    }

    public function testDispatch()
    {
        $controller = $this->getController();
        $controller->dispatch('index');
    }

    public function testGetView()
    {
        $this->assertInstanceOf('\Gria\View\View', $this->getController()->getView());
    }

	public function testRespond()
	{
		$controller = $this->getController();
        $controller->disableView();
		$controller->dispatch('index');
		$controller->render();
        $controller->respond();
        $this->assertNull($controller->getResponse()->getBody());
	}

    public function testRender()
    {
        $controller = $this->getController();
        $controller->disableView();
        $controller->dispatch('index');
        $controller->render();
        $response = $controller->getResponse();
        $this->assertEquals(false, $controller->isViewEnabled());
        $this->assertInstanceOf('\Gria\Http\ResponseInterface', $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function getController()
    {
        return $this->_controller;
    }


} 
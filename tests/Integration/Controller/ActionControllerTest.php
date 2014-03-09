<?php

namespace GriaTest\Integration\Controller;

use \Gria\Controller;
use \Gria\Helper;
use \Gria\Test;

/**
 * Tests {@link \Gria\Controller\ActionController}.
 *
 * @package GriaTest\Integration\Controller
 */
class ActionControllerTest extends Test\ControllerTest
{

    /** @var \Gria\Controller\ActionController */
    private $_controller;

    /**
     * Tests {@link \Gria\Controller\ActionController::init()}.
     *
     * @return void
     */
    public function testInit()
    {
        $controller = $this->getMock('\Gria\Controller\ActionController', null, array(), '', false);
        $this->assertEmpty($controller->getView());
    }

    /**
     * Tests {@link \Gria\Controller\ActionController::getView()}.
     *
     * @return void
     */
    public function testGetView()
    {
        $this->assertInstanceOf('\Gria\View\View', $this->getMockActionController()->getView());
    }

    /**
     * Tests {@link \Gria\Controller\ActionController::getName()}.
     *
     * @return void
     */
    public function testGetName()
    {
        $this->assertEquals('actioncontroller', $this->getMockActionController()->getName());
    }

    /**
     * Tests error condition of {@link \Gria\Controller\ActionController::dispatch()}.
     *
     * @return void
     */
    public function testInvalidDispatch()
    {
        try {
            $controller = $this->getMockActionController();
            $controller->dispatch('invalid');
        } catch(\Exception $ex) {
            $this->assertInstanceOf('\Gria\Controller\InvalidActionException', $ex);
            $this->assertEquals(500, $ex->getCode());
        }
    }

    /**
     * Tests {@link \Gria\Controller\ActionController::dispatch()}.
     *
     * @return void
     */
    public function testDispatch()
    {
        $config = $this->getMockConfig();
        $request = $this->getMockRequest();
        $helperManager = $this->getMockHelperManager();
        $constructorArgs = [$request, $config, $helperManager];
        $controller = $this->getMock('\Gria\Controller\ActionController', array('indexAction'), $constructorArgs);
        $controller->expects($this->once())->method('indexAction')->will($this->returnValue(null));
        $controller->dispatch('index');
    }

    /**
     * Tests {@link \Gria\Controller\ActionController::disableView()}.
     *
     * @return void
     */
    public function testDisableView()
    {
        $controller = $this->getMockActionController();
        $controller->disableView();
        $this->assertFalse($controller->isViewEnabled());
    }

    /**
     * Tests {@link \Gria\Controller\ActionController::enableView()}.
     *
     * @return void
     */
    public function testEnableView()
    {
        $controller = $this->getMockActionController();
        $controller->disableView();
        $controller->enableView();
        $this->assertTrue($controller->isViewEnabled());
    }

    /**
     * Tests {@link \Gria\Controller\ActionController::render()}.
     *
     * @return void
     */
    public function testRenderNoView()
    {
        $config = $this->getMockConfig();
        $request = $this->getMockRequest();
        $helperManager = $this->getMockHelperManager();
        $constructorArgs = [$request, $config, $helperManager];
        $controller = $this->getMock('\Gria\Controller\ActionController', array('isViewEnabled'), $constructorArgs);
        $controller->expects($this->once())->method('isViewEnabled')->will($this->returnValue(false));
        $controller->render();
        $response = $controller->getResponse();
        $this->assertEmpty($response->getBody());
    }

    /**
     * Tests {@link \Gria\Controller\ActionController::respond()}.
     *
     * @return void
     */
    public function testRespond()
    {
        $controller = $this->getMockActionController();
        $controller->disableView();
        $controller->dispatch('index');
        $controller->render();
        $response = $controller->getResponse();
        $this->assertInstanceOf('\Gria\Http\ResponseInterface', $response);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return \Gria\Controller\ActionController
     */
    public function getMockActionController()
    {
        $config = $this->getMockConfig();
        $request = $this->getMockRequest();
        $helperManager = $this->getMockHelperManager();
        $controller = new Controller\ActionController($request, $config, $helperManager);
        return $controller;
    }

}
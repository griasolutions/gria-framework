<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class DispatcherTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Gria\Controller\Request */
    private $_request;

    public function setUp()
    {
        $this->_request = $this->getMock('\Gria\Controller\Request', array(
            'getHost', 'getUri', 'getControllerName', 'getActionName'));
        $this->_request->expects($this->any())
            ->method('getHost')
            ->will($this->returnValue('localhost'));
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testGetErrorController()
    {
        $this->markTestSkipped();
        $this->getRequest()->expects($this->any())
            ->method('getControllerName')
            ->will($this->returnValue('stupidness'));
        $dispatcher = new Controller\Dispatcher($this->getRequest(), $this->getConfig());
        $dispatcher->getController();
    }

    public function testGetValidController()
    {
        $this->markTestSkipped();
        $this->getRequest()->expects($this->any())
            ->method('getControllerName')
            ->will($this->returnValue('dashboard'));
        $dispatcher = new Controller\Dispatcher($this->getRequest(), $this->getConfig());
        $this->assertInstanceOf('\Application\Controller\Dashboard', $dispatcher->getController());
    }

    /**
     * @return \Gria\Controller\Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

} 
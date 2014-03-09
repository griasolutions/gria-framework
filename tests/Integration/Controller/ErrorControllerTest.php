<?php

namespace GriaTest\Integration\Controller;

use \Gria\Controller;
use \Gria\Test;

class ErrorControllerTest extends Test\ControllerTest
{

    private $_controller;

    public function setUp()
    {
        parent::setUp();
        /*$this->getRequest()->expects($this->any())
            ->method('getUri')
            ->will($this->returnValue('/test'));*/
        /*$this->setController(new Controller\ErrorController($this->getRequest(), $this->getHelperManager(), $this->getConfig()));*/
    }

    public function testSetGetException()
    {
        $this->markTestSkipped();
        /*
        $exception = new \Exception('test', 500);
		$this->getController()->setException($exception);
		$this->assertEquals($exception, $this->getController()->getException());
	    */
    }

    public function testRoute()
    {
        $this->markTestSkipped();
        /*$this->getController()->route();
		$this->assertNotEquals(200, $this->getController()->getView()->get('statusCode'));*/
    }

    public function getController()
    {
        return $this->_controller;
    }

} 
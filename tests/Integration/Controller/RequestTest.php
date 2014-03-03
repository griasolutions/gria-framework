<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class RequestTest extends \PHPUnit_Framework_TestCase
{

    private $_request;

	public function setUp()
	{
		$this->_request = new Controller\Request('http://localhost/test')
	}

	public function testGetUrl()
	{
		$this->assertEquals('http://localhost/test', $this->getRequest()->getUrl());
	}

	public function testToString()
	{
		$this->assertEquals('http://localhost/test', $this->getRequest()->__toString());
	}

	public function testDefaultGetControllerName()
	{
		$dashboardRequest = $this->getMock('\Gria\Controller\Request', array(
			'getHost', 'getUri'));
		$dashboardRequest->expects($this->any())
			->method('getHost')
			->will($this->returnValue('localhost'));
		$dashboardRequest->expects($this->any())
			->method('getUri')
			->will($this->returnValue('/'));
		$this->assertEquals('dashboard', $dashboardRequest->getControllerName());
	}

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->_request;
    }

} 
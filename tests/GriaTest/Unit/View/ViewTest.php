<?php

namespace GriaTest\Unit\View;

use \Gria\View;
use \Gria\Config;
use \GriaTest\Unit\Controller;

class ViewTest extends \PHPUnit_Framework_TestCase
{

	use Controller\RequestAwareTestTrait {
		setUp as requestTraitSetup;
	}

	private $_view;

	public function setUp()
	{
		$this->requestTraitSetup();
		$this->_view = new View\View($this->getRequest(), $this->getConfig());
	}

	public function testGetSet()
	{
		$expectedValue = 'data';
		$this->getView()->set('example', $expectedValue);
		$this->assertEquals($expectedValue, $this->getView()->get('example'));
	}

	public function testGetSetSourcePath()
	{
		$expectedValue = 'example.phtml';
		$this->getView()->setSourcePath($expectedValue);
		$this->assertEquals($expectedValue, $this->getView()->getSourcePath());
	}

	public function testGetControllerName()
	{
		$this->_request->expects($this->any())
			->method('getControllerName')
			->will($this->returnValue('test'));
		$this->assertEquals('test', $this->getView()->getControllerName());
	}

	public function getView()
	{
		return $this->_view;
	}

} 
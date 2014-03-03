<?php

namespace GriaTest\Unit\View;

use \Gria\View;
use \Gria\Config;
use \Gria\Helper;

class ViewTest extends \PHPUnit_Framework_TestCase
{

	/** @var \Gria\View\View */
    private $_view;

	public function setUp()
	{
        $this->getMock('\IniParser', array('parse'))
            ->expects($this->any())
            ->method('parse')
            ->will($this->returnValue(array(
                'name' => 'Test Application'
            )
        ));
        $config = new Config\Config('example.ini');
        $this->_view = new View\View($config, new Helper\Manager($config));
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

	public function getView()
	{
		return $this->_view;
	}

} 
<?php

namespace GriaTest\Unit\Config;

use \Gria\Config;
use Gria\Controller\Controller;

class ConfigTest extends \PHPUnit_Framework_TestCase
{

	const ERROR_FORMAT = 'Cannot read %s from the config!';

	/** @var \Gria\Config\Config */
	private $_config;

	/** @var array */
	private $_fixtureData = array(
		'test' => array(
			'application' => 'Application',
			'answer' => 42,
			'isTest' => true
		)
	);

	public function setUp()
	{
		$this->getMock('\IniParser', array('parse'))
			->expects($this->any())
			->method('parse')
			->will($this->returnValue($this->getFixtureData()));
		$this->_config = new Config\Config();
	}

	public function testGetString()
	{
		$this->assertEquals('Application', $this->getConfig()->get('application'), sprintf(self::ERROR_FORMAT, 'strings'));
	}

	public function testGetIntegers()
	{
		$this->assertEquals(42, $this->getConfig()->get('answer'), sprintf(self::ERROR_FORMAT, 'integers'));
	}

	public function testGetBooleans()
	{
		$this->assertEquals(true, $this->getConfig()->get('isTest'), sprintf(self::ERROR_FORMAT, 'booleans'));
	}

	public function testGetConfig()
	{
		$this->assertEquals($this->getFixtureData(), $this->getConfig()->getData());
	}

	public function testGetPath()
	{
		$this->assertEquals(realpath('tests/data/test.ini'), $this->getConfig()->getPath());
	}

	/**
	 * @return \Gria\Config\Config
	 */
	public function getConfig()
	{
		return $this->_config;
	}

	/**
	 * @return array
	 */
	public function getFixtureData()
	{
		return $this->_fixtureData;
	}

} 
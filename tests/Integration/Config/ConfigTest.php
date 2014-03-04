<?php

namespace GriaTest\Unit\Config;

use \Gria\Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{

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

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->_config = $this->getMock('\Gria\Config\Config', array('getRawData'));
        $this->_config->expects($this->any())
            ->method('getRawData')
            ->will($this->returnValue($this->getFixtureData()));
    }

    /**
     * Tests whether or not we can get the correct values out of the config.
     */
    public function testGetValues()
    {
        $errorMessageFormat = 'Cannot read %s from the config!';
        $config = $this->getConfig();
        $this->assertEquals('Application', $config->get('application'), sprintf($errorMessageFormat, 'strings'));
        $this->assertEquals(42, $config->get('answer'), sprintf($errorMessageFormat, 'integers'));
        $this->assertEquals(true, $config->get('isTest'), sprintf($errorMessageFormat, 'booleans'));
    }

    /**
     * Tests that the correct path is returned once set.
     */
    public function testGetPath()
    {
        $config = $this->getConfig();
        $this->assertEquals('', $config->getPath());
        $config->setPath(__FILE__);
        $this->assertEquals(__FILE__, $config->getPath());
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
<?php

namespace GriaTest\Integration\Config;

use \Gria\Config;

/**
 * Tests {@link \Gria\Config\Config}.
 *
 * @package GriaTest\Integration\Config
 */
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
     * Tests {@link \Gria\Config\Config::get()}.
     *
     * @return void
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
     * Tests {@link \Gria\Config\Config::getPath()}.
     *
     * @return void
     */
    public function testGetPath()
    {
        $config = $this->getConfig();
        $this->assertEquals('', $config->getPath());
        $config->setPath(__FILE__);
        $this->assertEquals(__FILE__, $config->getPath());
    }

    /**
     * Returns an instance of {@link \Gria\Config\Config}.
     *
     * @return \Gria\Config\Config
     */
    public function getConfig()
    {
        return $this->_config;
    }

    /**
     * Returns an array of fixture data.
     *
     * @return array
     */
    public function getFixtureData()
    {
        return $this->_fixtureData;
    }

} 
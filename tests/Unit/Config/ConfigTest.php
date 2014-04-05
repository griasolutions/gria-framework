<?php

namespace GriaTest\Unit\Config;

use \Gria\Config;
use \Gria\Test;

class ConfigTest extends Test\UnitTest
{

    /** @var \Gria\Config\ConfigInterface */
    private $config;

    /** @var array */
    private $fixtureData = array(
        'test' => array(
            'application' => 'Application',
            'answer' => 42,
            'isTest' => true
        )
    );

    public function testGetValues()
    {
        $config = $this->getConfig();
        $this->assertEquals('Application', $config->get('application'));
        $this->assertEquals(42, $config->get('answer'));
        $this->assertEquals(true, $config->get('isTest'));
    }

    public function testGetPath()
    {
        $config = $this->getConfig();
        $this->assertEquals('', $config->getPath());
        $config->setPath(__FILE__);
        $this->assertEquals(__FILE__, $config->getPath());
    }

    /**
     * Returns an instance of {@link \Gria\Config\ConfigInterface}.
     *
     * @return \Gria\Config\ConfigInterface
     */
    public function getConfig()
    {
        if (!$this->config) {
            $this->config = $this->getMock('\Gria\Config\Config',
                array('getRawData'),
                array('example.ini', $this->getMockEnvironment()));
            $this->config->expects($this->any())
                ->method('getRawData')
                ->will($this->returnValue($this->getFixtureData()));
        }
        return $this->config;
    }

    /**
     * Returns an array of fixture data.
     *
     * @return array
     */
    public function getFixtureData()
    {
        return $this->fixtureData;
    }

} 
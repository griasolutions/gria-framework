<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Application\Environment;

use \Gria\Application\Environment;
use \Gria\Test;

class EnvironmentTest extends Test\UnitTest
{

    /** @var \Gria\Application\Environment\EnvironmentInterface */
    private $environment;

    public function testToString()
    {
        $this->assertEquals('test', (string) $this->getEnvironment());
    }

    public function testGetName()
    {
        $this->assertEquals('test', $this->getEnvironment()->getName());
    }

    public function testIsProduction()
    {
        $this->assertFalse($this->getEnvironment()->isProduction());
        $this->assertTrue($this->getMockEnvironment('production')->isProduction());
    }

    public function testIsQa()
    {
        $this->assertFalse($this->getEnvironment()->isQa());
        $this->assertTrue($this->getMockEnvironment('qa')->isQa());
    }

    public function testIsDevelopment()
    {
        $this->assertFalse($this->getEnvironment()->isDevelopment());
        $this->assertTrue($this->getMockEnvironment('development')->isDevelopment());
    }

    public function testIsTest()
    {
        $this->assertTrue($this->getEnvironment()->isTest());
        $this->assertTrue($this->getMockEnvironment('test')->isTest());
    }

    /**
     * @return \Gria\Application\Environment\Environment
     */
    public function getEnvironment()
    {
        if (!$this->environment) {
            $this->environment = new Environment\Environment();
        }
        return $this->environment;
    }

} 
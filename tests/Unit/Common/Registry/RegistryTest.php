<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Common;

use \Gria\Common;

class RegistryTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Gria\Common\Registry\RegistryInterface */
    private $registry;

    /** @var array */
    private $expectedRegistryData;

    public function setUp()
    {
        $person = new \stdClass();
        $person->name = 'Guillermo Fisher';
        $person->age = '999';
        $this->expectedRegistryData = array(
            'person' => $person,
            'state' => 'confusion'
        );
        $this->registry = new Common\Registry\Registry($this->expectedRegistryData);
    }

    public function testOffsetExists()
    {
        $this->assertTrue($this->getRegistry()->offsetExists('person'));
        $this->assertFalse($this->getRegistry()->offsetExists('animal'));
        $this->assertTrue(isset($this->getRegistry()['person']));
    }

    public function testOffsetSet()
    {
        $this->getRegistry()->offsetSet('example', 'data');
        $this->getRegistry()['mocking'] = 'bird';
        $this->assertEquals('data', $this->getRegistry()->offsetGet('example'));
        $this->assertEquals('bird', $this->getRegistry()->offsetGet('mocking'));
    }

    public function testOffsetGet()
    {
        $this->assertEquals('confusion', $this->getRegistry()->offsetGet('state'));
        $this->assertEquals('confusion', $this->getRegistry()['state']);
    }

    public function testOffsetUnset()
    {
        $this->getRegistry()->offsetSet('junk', 'data');
        $this->getRegistry()->offsetSet('junkier', 'data');
        unset($this->getRegistry()['junk']);
        $this->getRegistry()->offsetUnset('junkier');
        $this->assertFalse($this->getRegistry()->offsetExists('junk'));
        $this->assertFalse($this->getRegistry()->offsetExists('junkier'));
    }

    /**
     * Returns the registry.
     *
     * @return \Gria\Common\Registry\RegistryInterface
     */
    public function getRegistry()
    {
        return $this->registry;
    }

    /**
     * Returns the array of expected data.
     *
     * @return array
     */
    public function getExpectedRegistryData()
    {
        return $this->expectedRegistryData;
    }

}
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Common;

use \Gria\Common;

/**
 * Tests {@link \Gria\Common\Registry}.
 *
 * @package GriaTest\Unit\Common
 */
class RegistryTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Gria\Common\RegistryInterface */
    private $_registry;

    /** @var array */
    private $_expectedRegistryData;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $person = new \stdClass();
        $person->name = 'Guillermo Fisher';
        $person->age = '999';
        $this->_expectedRegistryData = array(
            'person' => $person,
            'state' => 'confusion'
        );
        $this->_registry = new Common\Registry($this->_expectedRegistryData);
    }

    /**
     * Tests RegistryInterface::offsetExists()
     *
     * @return void
     */
    public function testOffsetExists()
    {
        $this->assertTrue($this->getRegistry()->offsetExists('person'));
        $this->assertFalse($this->getRegistry()->offsetExists('animal'));
        $this->assertTrue(isset($this->getRegistry()['person']));
    }

    /**
     * Tests RegistryInterface::offsetSet()
     *
     * @return void
     */
    public function testOffsetSet()
    {
        $this->getRegistry()->offsetSet('example', 'data');
        $this->getRegistry()['mocking'] = 'bird';
        $this->assertEquals('data', $this->getRegistry()->offsetGet('example'));
        $this->assertEquals('bird', $this->getRegistry()->offsetGet('mocking'));
    }

    /**
     * Tests RegistryInterface::offsetGet()
     *
     * @return void
     */
    public function testOffsetGet()
    {
        $this->assertEquals('confusion', $this->getRegistry()->offsetGet('state'));
        $this->assertEquals('confusion', $this->getRegistry()['state']);
    }

    /**
     * Tests RegistryInterface::offsetUnset()
     *
     * @return void
     */
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
     * @return \Gria\Common\Registry
     */
    public function getRegistry()
    {
        return $this->_registry;
    }

    /**
     * Returns the array of expected data.
     *
     * @return array
     */
    public function getExpectedRegistryData()
    {
        return $this->_expectedRegistryData;
    }

}
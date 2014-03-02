<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common;

class RegistryTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Gria\Common\RegistryInterface */
    private $_registry;

    /** @var array */
    private $_expectedRegistryData;

    /**
     * Sets up the registry object.
     *
     * @return void
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
        $this->_registry = new Registry($this->_expectedRegistryData);
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
     * @return mixed
     */
    public function getRegistry()
    {
        return $this->_registry;
    }

    /**
     * @return mixed
     */
    public function getExpectedRegistryData()
    {
        return $this->_expectedRegistryData;
    }

}
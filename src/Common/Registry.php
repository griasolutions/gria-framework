<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common;

/**
 * Concrete implementation of the {@link \Gria\Common\RegistryInterface}.
 *
 * @package Gria\Common
 */
class Registry implements RegistryInterface
{

    /** @var array */
    private $_registry = [];

    /**
     * Constructor.
     *
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        foreach ($data as $offset => $value) {
            $this->offsetSet($offset, $value);
        }
    }

    /**
     * @see \Gria\Common\Registry::has()
     * @param $offset
     * @return bool
     */
    public function has($offset)
    {
        return $this->offsetExists($offset);
    }

    /**
     * @see \Gria\Common\Registry::get()
     * @param $offset
     * @return mixed
     */
    public function get($offset)
    {
        return $this->offsetGet($offset);
    }

    /**
     * @see \Gria\Common\Registry::set()
     * @param string $offset
     * @param mixed $value
     * @return \Gria\Common\Registry
     */
    public function set($offset, $value)
    {
        return $this->offsetSet($offset, $value);
    }

    /**
     * @see \Gria\Common\Registry::has()
     * @param $offset
     * @return bool
     */
    public function remove($offset)
    {
        return $this->offsetUnset($offset);
    }

    /**
     * Determines whether or not an offset is registered with the class.
     *
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        $encodedOffset = $this->encodeOffset($offset);

        return isset($this->_registry[$encodedOffset]);
    }

    /**
     * Retrieves the value associated with the provided offset if the offset is registered with the class.
     *
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        $encodedOffset = $this->encodeOffset($offset);
        if ($this->offsetExists($encodedOffset)) {
            return $this->_registry[$encodedOffset];
        }
    }

    /**
     * Registers the provided value with the class using the provided offset.
     *
     * @param mixed $offset
     * @param mixed $value
     * @return \Gria\Common\Registry
     */
    public function offsetSet($offset, $value)
    {
        $encodedOffset = $this->encodeOffset($offset);
        $this->_registry[$encodedOffset] = $value;
        return $this;
    }

    /**
     * Un-registers an offset and the associated value with the class.
     *
     * @param mixed $offset
     * @return \Gria\Common\Registry
     */
    public function offsetUnset($offset)
    {
        $encodedOffset = $this->encodeOffset($offset);
        unset($this->_registry[$encodedOffset]);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function encodeOffset($offset)
    {
        return $offset;
    }

} 
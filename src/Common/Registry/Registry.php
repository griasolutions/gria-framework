<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common\Registry;

class Registry implements RegistryInterface
{

    /** @var array */
    private $registry = [];

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
     * @inheritdoc
     */
    public function has($offset)
    {
        return $this->offsetExists($offset);
    }

    /**
     * @inheritdoc
     */
    public function get($offset)
    {
        return $this->offsetGet($offset);
    }

    /**
     * @inheritdoc
     */
    public function set($offset, $value)
    {
        return $this->offsetSet($offset, $value);
    }

    /**
     * @inheritdoc
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
        return isset($this->registry[$encodedOffset]);
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
            return $this->registry[$encodedOffset];
        }
    }

    /**
     * Registers the provided value with the class using the provided offset.
     *
     * @param mixed $offset
     * @param mixed $value
     * @return \Gria\Common\Registry\RegistryInterface
     */
    public function offsetSet($offset, $value)
    {
        $encodedOffset = $this->encodeOffset($offset);
        $this->registry[$encodedOffset] = $value;
        return $this;
    }

    /**
     * Un-registers an offset and the associated value with the class.
     *
     * @param mixed $offset
     * @return \Gria\Common\Registry\RegistryInterface
     */
    public function offsetUnset($offset)
    {
        $encodedOffset = $this->encodeOffset($offset);
        unset($this->registry[$encodedOffset]);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function encodeOffset($offset)
    {
        return $offset;
    }

    /**
     * @inheritdoc
     */
    public function getRegistry()
    {
        return $this->registry;
    }

}
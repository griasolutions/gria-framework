<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common\Registry;

interface RegistryInterface extends \ArrayAccess
{

    /**
     * @see \Gria\Common\Registry\Registry::offsetExists()
     * @param $offset
     * @return bool
     */
    public function has($offset);

    /**
     * @see \Gria\Common\Registry\Registry::offsetGet()
     * @param $offset
     * @return mixed
     */
    public function get($offset);

    /**
     * @see \Gria\Common\Registry\Registry::offsetSet()
     * @param string $offset
     * @param mixed $value
     * @return \Gria\Common\Registry\RegistryInterface
     */
    public function set($offset, $value);

    /**
     * @see \Gria\Common\Registry\Registry::offsetUnset()
     * @param $offset
     * @return bool
     */
    public function remove($offset);

    /**
     * Encodes the offset that is registered with the class.
     *
     * @param mixed $offset
     * @return mixed
     */
    public function encodeOffset($offset);

    /**
     * Returns the registry.
     *
     * @return array
     */
    public function getRegistry();

}
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common\Registry;

/**
 * Defines the API for {@link \Gria\Common\Registry} classes. Extends {@link \ArrayAccess}.
 *
 * @package Gria\Common
 */
interface RegistryInterface extends \ArrayAccess
{

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
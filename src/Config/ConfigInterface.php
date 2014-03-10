<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Config;

/**
 * Defines the API for {@link \Gria\Config\Config} classes.
 *
 * @package Gria\Config
 */
interface ConfigInterface
{

    /**
     * Returns the value associated with the provided key.
     *
     * @param $key
     * @return mixed
     */
    public function get($key);

}
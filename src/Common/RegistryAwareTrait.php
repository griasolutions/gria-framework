<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common;

/**
 * Defines the API for classes that are aware of instances of the {@link \Gria\Common\RegistryInterface} interface.
 *
 * @package Gria\Common
 */
trait RegistryAwareTrait
{

    /** @var \Gria\Common\RegistryInterface */
    private $_registry;

    /**
     * Registers the provided {@link \Gria\Common\RegistryInterface} with this class.
     *
     * @param \Gria\Common\RegistryInterface $registry
     * @return \Gria\Common\RegistryAwareTrait
     */
    public function setRegistry(RegistryInterface $registry)
    {
        $this->_registry = $registry;
        return $this;
    }

    /**
     * Returns the instance of {@link \Gria\Common\RegistryInterface} registered with this class.
     *
     * @return \Gria\Common\RegistryInterface $registry
     */
    public function getRegistry()
    {
        return $this->_registry;
    }

}
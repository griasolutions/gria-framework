<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common\Registry;

/**
 * Defines the API for classes that are aware of instances of the {@link \Gria\Common\RegistryInterface} interface.
 *
 * @package Gria\Common\Registry
 */
trait RegistryAwareTrait
{

    /** @var \Gria\Common\Registry\RegistryInterface */
    private $registry;

    /**
     * Registers the provided {@link \Gria\Common\Registry\RegistryInterface} with this class.
     *
     * @param \Gria\Common\Registry\RegistryInterface $registry
     * @return \Gria\Common\Registry\RegistryAwareTrait
     */
    public function setRegistry(RegistryInterface $registry)
    {
        $this->registry = $registry;
        return $this;
    }

    /**
     * Returns the instance of {@link \Gria\Common\Registry\RegistryInterface} registered with this class.
     *
     * @return \Gria\Common\Registry\RegistryInterface $registry
     */
    public function getRegistry()
    {
        return $this->registry;
    }

}
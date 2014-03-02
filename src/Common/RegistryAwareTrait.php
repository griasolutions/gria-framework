<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common;

trait RegistryAwareTrait
{

    /** @var \Gria\Common\RegistryInterface */
    private $_registry;

    /**
     * @param \Gria\Common\RegistryInterface $registry
     * @return $this
     */
    public function setRegistry(RegistryInterface $registry)
    {
        $this->_registry = $registry;
    }

    /**
     * @return \Gria\Common\RegistryInterface $registry
     */
    public function getRegistry()
    {
        return $this->_registry;
    }

}
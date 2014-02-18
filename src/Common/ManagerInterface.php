<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common;

interface ManagerInterface
{

    /**
     * @param \Gria\Common\RegistryInterface $registry
     * @return $this
     */
    public function setRegistry(RegistryInterface $registry);

    /**
     * @return \Gria\Common\RegistryInterface $registry
     */
    public function getRegistry();

    /**
     * @param \Gria\Common\AbstractFactoryInterface $abstractFactory
     * @return $this
     */
    public function setAbstractFactory(AbstractFactoryInterface $abstractFactory);

    /**
     * @return \Gria\Common\AbstractFactoryInterface
     */
    public function getAbstractFactory();

} 
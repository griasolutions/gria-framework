<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper;

use \Gria\Common;
use \Gria\Config;

class Manager implements Common\ManagerInterface
{

    use Config\ConfigAwareTrait;

    /** @var \Gria\Helper\Registry */
    private $_registry;

    /** @var \Gria\Helper\AbstractFactory */
    private $_abstractFactory;

    /**
     * @param \Gria\Config\ConfigInterface $config
     */
    public function __construct(Config\ConfigInterface $config)
    {
        $this->setConfig($config)
            ->setRegistry(new Registry())
            ->setAbstractFactory(new AbstractFactory());
    }

    /**
     * @param string $name
     * @throws InvalidHelperException
     * @return \Gria\Helper\HelperInterface
     */
    public function get($name)
    {
        $registry = $this->getRegistry();
        if (isset($registry[$name])) {
            return $registry[$name];
        }
        $factory = $this->getAbstractFactory();
        if ($helper = $factory->get($name)) {
            $registry[$name] = $helper;
            return $helper;
        }
        throw new InvalidHelperException(sprintf('% is an invalid helper', $name));
    }

    /**
     * @param \Gria\Common\RegistryInterface|\Gria\Helper\Registry $registry
     * @return $this
     */
    public function setRegistry(Common\RegistryInterface $registry)
    {
        $this->_registry = $registry;
        return $this;
    }

    /**
     * @return \Gria\Helper\Registry
     */
    public function getRegistry()
    {
        return $this->_registry;
    }

    /**
     * @param \Gria\Common\AbstractFactoryInterface|\Gria\Helper\AbstractFactory $abstractFactory
     * @return $this
     */
    public function setAbstractFactory(Common\AbstractFactoryInterface $abstractFactory)
    {
        $this->_abstractFactory = $abstractFactory;
        return $this;
    }

    /**
     * @return \Gria\Helper\AbstractFactory
     */
    public function getAbstractFactory()
    {
        return $this->_abstractFactory;
    }

}
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper\Manager;

use \Gria\Common;
use \Gria\Config;
use \Gria\Helper;

class Manager implements ManagerInterface
{

    use Config\ConfigAwareTrait, Common\Registry\RegistryAwareTrait;

    /**
     * @param \Gria\Config\ConfigInterface $config
     */
    public function __construct(Config\ConfigInterface $config)
    {
        $this->setConfig($config)->setRegistry(new Helper\Registry());
    }

    public function update(Helper\HelperInterface $helper)
    {

    }

    /**
     * @throws \Gria\Helper\Exception\InvalidHelperException
     * @param string $name
     * @return \Gria\Helper\HelperInterface
     */
    public function getHelper($name)
    {
        $registry = $this->getRegistry();
        if (isset($registry[$name])) {
            return $registry[$name];
        }
        if ($helper = $this->_createHelper($name)) {
            $this->getRegistry()->offsetSet($name, $helper);

            return $helper;
        }
        throw new Helper\Exception\InvalidHelperException(sprintf('%s is an invalid helper', $name));
    }

    /**
     * @param string $name
     * @return \Gria\Helper\HelperInterface
     */
    private function _createHelper($name)
    {
        $namespaces = array($this->getConfig()->get('namespace') ?: 'Application', 'Gria');
        $classNameFormat = '\%s\Helper\%sHelper';
        foreach ($namespaces as $namespace) {
            $className = sprintf($classNameFormat, $namespace, ucwords($name));
            if (class_exists($className)) {
                $helper = new $className($this->getConfig());
                return $helper;
            }
        }
    }

}
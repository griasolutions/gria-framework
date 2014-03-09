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

class Manager
{

    use Config\ConfigAwareTrait, Common\RegistryAwareTrait;

    /**
     * @param \Gria\Config\ConfigInterface $config
     */
    public function __construct(Config\ConfigInterface $config)
    {
        $this->setConfig($config)->setRegistry(new Registry());
    }

    /**
     * @param string $name
     * @throws InvalidHelperException
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
        throw new InvalidHelperException(sprintf('% is an invalid helper', $name));
    }

    /**
     * @param string $name
     * @return \Gria\Helper\HelperInterface
     */
    private function _createHelper($name)
    {
        $className = '\Application\Helper\\' . $name;
        if (class_exists($className)) {
            $helper = new $className;

            return $helper;
        }
    }

}
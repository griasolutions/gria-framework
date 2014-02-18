<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Common;
use \Gria\Config;
use \Gria\Helper;

class AbstractFactory implements Common\AbstractFactoryInterface
{

    use RequestAwareTrait, Config\ConfigAwareTrait, Helper\HelperManagerAwareTrait;

    /**
     * @param \Gria\Controller\Request $request
     * @param \Gria\Config\ConfigInterface $config
     * @param \Gria\Helper\Manager $helperManager
     */
    public function __construct(Request $request, Config\ConfigInterface $config, Helper\Manager $helperManager)
    {
        $this->setRequest($request);
        $this->setConfig($config);
        $this->setHelperManager($helperManager);
    }

    /**
     * @param string $name
     * @return \Gria\Controller\ControllerInterface
     */
    public function get($name)
    {
        $config = $this->getConfig();
        $request = $this->getRequest();
        $controllerClassName = '\Application\Controller\\' . ucfirst($name);
        try {
            $helperManager = $this->getHelperManager();
            $reflectionClass = new \ReflectionClass($controllerClassName);
            $controller = $reflectionClass->newInstance($request, $config, $helperManager);
            return $controller;
        } catch (\ReflectionException $ex) {
            return false;
        }
    }

}
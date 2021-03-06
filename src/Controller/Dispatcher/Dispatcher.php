<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller\Dispatcher;

use \Gria\Controller;
use \Gria\Config;
use \Gria\Http;
use \Gria\Helper;

/**
 * Dispatches requests to controllers.
 *
 * @package Gria\Controller
 */
class Dispatcher implements DispatcherInterface
{

    use Config\ConfigAwareTrait, Http\Request\RequestAwareTrait, Helper\Manager\HelperManagerAwareTrait;

    /**
     * @param \Gria\Config\ConfigInterface $config
     * @param \Gria\Controller\Request\RequestInterface $request
     * @param \Gria\Helper\Manager\ManagerInterface $helperManager
     */
    public function __construct(Config\ConfigInterface $config, Controller\Request\RequestInterface $request, Helper\Manager\ManagerInterface $helperManager)
    {
        $this->setConfig($config);
        $this->setRequest($request);
        $this->setHelperManager($helperManager);
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        try {
            $controllerName = $this->getControllerName();
            $controller = $this->getController($controllerName);
            $controller->dispatch($this->getActionName());
            $controller->render();
            $controller->respond();
        } catch (\Exception $ex) {
            try {
                $controller = $this->getController('error', $ex);
                $controller->dispatch($this->getActionName());
                $controller->render();
                $controller->respond();
            } catch (\Exception $newEx) {
                die('<div>' . $newEx->getMessage() . '!</div>');
            }
        }
    }

    /**
     * @inheritdoc
     * @throws \Gria\Controller\Exception\InvalidControllerException
     */
    public function getController($controllerName, \Exception $exception = null)
    {
        $config = $this->getConfig();
        $namespace = $config->get('namespace') ?: 'Application';
        $controllerClassName = '\\' . $namespace . '\Controller\\' . ucfirst($controllerName);
        try {
            $reflectionClass = new \ReflectionClass($controllerClassName);
            $controller = $reflectionClass->newInstance($this->getRequest(), $config, $this->getHelperManager());
            if (method_exists($controller, 'setException')) {
                $controller->setException($exception);
            }

            return $controller;
        } catch (\ReflectionException $ex) {
            if ($controllerName == 'error') {
                $errorMessage = 'Please define an error controller and view for your application';
            } else {
                $errorMessage = sprintf('Could not find the %s controller', $controllerName);
            }
            throw new Controller\Exception\InvalidControllerException($errorMessage);
        }
    }

    /**
     * @inheritdoc
     */
    public function getControllerName()
    {
        $uriSegments = $this->getRequest()->getUriSegments();
        if (!isset($uriSegments[0]) || $uriSegments[0] == '') {
            $routes = $this->getConfig()->get('routes');

            return $routes['defaultController'] ? : 'index';
        }

        return $uriSegments[0];
    }

    /**
     * @inheritdoc
     */
    public function getActionName()
    {
        $uriSegments = $this->getRequest()->getUriSegments();
        if (!isset($uriSegments[1]) || $uriSegments[1] == '') {
            $routes = $this->getConfig()->get('routes');

            return $routes['defaultAction'] ? : 'index';
        }

        return strtolower($uriSegments[1]);
    }

}
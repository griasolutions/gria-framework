<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Config;
use \Gria\Http;
use \Gria\Helper;

class Dispatcher
{

	use Config\ConfigAwareTrait, Http\RequestAwareTrait, Helper\HelperManagerAwareTrait;

    /**
     * @param \Gria\Config\ConfigInterface $config
     */
	public function __construct(Config\ConfigInterface $config)
	{
        $this->setConfig($config);
		$this->setRequest(new Request());
        $this->setHelperManager(new Helper\Manager($config));
    }

	/**
	 * @return void
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
     * @param string $controllerName
     * @param \Exception $exception
     * @return \Gria\Controller\ControllerInterface
     * @throws \Gria\Controller\InvalidControllerException
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
            throw new InvalidControllerException($errorMessage);
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
            return $routes['defaultController'] ?: 'index';
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
            return $routes['defaultAction'] ?: 'index';
        }
        return strtolower($uriSegments[1]);
    }

}
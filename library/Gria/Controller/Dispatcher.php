<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Config;

class Dispatcher
{

	use RequestAwareTrait, Config\ConfigAwareTrait;

	/** @var \Gria\Controller\Controller */
	private $_controller;

	/**
	 * @param \Gria\Controller\Request $request
	 * @param \Gria\Config\Config $config
	 */
	public function __construct(Request $request, Config\Config $config)
	{
		$this->setRequest($request);
		$this->setConfig($config);
	}

	/**
	 * @return void
	 */
	public function run()
	{
		try {
			$controller = $this->getController();
			$controller->route();
			$controller->render();
			$controller->respond();
		} catch (\Exception $ex) {
			$className = '\Gria\Controller\ErrorController';
			$applicationClassName = '\Application\Controller\Error';
			if (class_exists($applicationClassName)) {
				$className = $applicationClassName;
			}
			$this->_controller = (new \ReflectionClass($className))
				->newInstance($this->getRequest(), $this->getConfig())
				->setException($ex);
			$this->run();
		}
	}

	/**
	 * @throws \Gria\Controller\InvalidControllerException
	 * @return \Gria\Controller\Controller
	 */
	public function getController()
	{
		if (!$this->_controller) {
			$config = $this->getConfig();
			$request = $this->getRequest();
			$controllerName = $request->getControllerName();
			$controllerClassName = '\Application\Controller\\' . ucfirst($controllerName);
			try {
				$reflectionClass = new \ReflectionClass($controllerClassName);
				$controller = $reflectionClass->newInstance($request, $config);
				$this->_controller = $controller;
			} catch (\ReflectionException $ex) {
				throw new InvalidControllerException(sprintf('%s is not a valid controller', $controllerClassName));
			}
		}

		return $this->_controller;
	}

}
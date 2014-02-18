<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Config;
use \Gria\Helper;

class Dispatcher
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
	 * @return void
	 */
	public function run()
	{
		try {
			$desiredControllerName = $this->getRequest()->getControllerName();
            $this->_dispatch($desiredControllerName);
		} catch (\Exception $ex) {
            try {
                $this->_dispatch('error', $ex);
            } catch (\Exception $newEx) {
                die('<div>' . $newEx->getMessage() . '!</div>');
            }
		}
	}

    /**
     * @return \Gria\Controller\AbstractFactory
     */
    public function getAbstractFactory()
    {
        return new AbstractFactory($this->getRequest(), $this->getConfig(), $this->getHelperManager());
    }

    /**
     * @param string $controllerName
     * @param \Exception $exception
     * @throws InvalidControllerException
     */
    private function _dispatch($controllerName, \Exception $exception = null)
    {
        if (!$controller = $this->getAbstractFactory()->get($controllerName)) {
            if ($controllerName == 'error') {
                $errorMessage = 'Please define an error controller and view for your application';
            } else {
                $errorMessage = sprintf('%s is an invalid controller', $controllerName);
            }
            throw new InvalidControllerException($errorMessage);
        }
        if (method_exists($controller, 'setException')) {
            $controller->setException($exception);
        }
        $controller->route();
        $controller->render();
        $controller->respond();
    }

}
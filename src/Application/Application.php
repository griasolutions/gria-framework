<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Application;

use \Gria\Config;
use \Gria\Controller;
use \Gria\Helper;

class Application
{

	use Config\ConfigAwareTrait, Controller\RequestAwareTrait, Helper\HelperManagerAwareTrait;

    /** @var \Gria\Controller\Dispatcher */
    private $_controllerDispatcher;

    /**
     * @param \Gria\Config\ConfigInterface $config
     */
	public function __construct(Config\ConfigInterface $config)
	{
        $this->_checkEnvironment();
        $this->setConfig($config)
            ->setRequest(new Controller\Request($config))
            ->setHelperManager(new Helper\Manager($config));
	}

	/**
	 * @return void
	 */
	public function run()
	{
		$this->getControllerDispatcher()->run();
	}

    /**
     * @return \Gria\Controller\Dispatcher
     */
    public function getControllerDispatcher()
    {
        if (!$this->_controllerDispatcher) {
            $this->_controllerDispatcher = new Controller\Dispatcher(
                $this->getRequest(),
                $this->getConfig(),
                $this->getHelperManager()
            );
        }
        return $this->_controllerDispatcher;
    }

    /**
     * @return void
     */
    private function _checkEnvironment()
    {
        defined('GRIA_ENV') or die('No application environment defined!');
    }

}
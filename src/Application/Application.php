<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Application;

use \Gria\Config;
use \Gria\Http;
use \Gria\Controller;

/**
 * Performs initial checks and kicks off the MVC application. If any problems bubble up to this level, we simply stop
 * script execution and tell the user what is going on.
 */
class Application
{

	use Config\ConfigAwareTrait;

    /** @var \Gria\Controller\Dispatcher */
    private $_controllerDispatcher;

    /**
     * Constructor
     *
     * @param \Gria\Config\ConfigInterface $config
     */
	public function __construct(Config\ConfigInterface $config)
	{
        $this->checkEnvironment();
        $this->setConfig($config);
	}

    /**
     * Checks the environment
     *
     * @return void
     */
    public function checkEnvironment()
    {
        defined('GRIA_ENV') || die('No application environment defined!');
    }

	/**
     * Runs the controller dispatcher
     *
	 * @return void
	 */
	public function run()
	{
		try {
            $this->getControllerDispatcher()->run();
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
	}

    /**
     * Retrieves an instance of the controller dispatcher
     *
     * @return \Gria\Controller\Dispatcher
     */
    public function getControllerDispatcher()
    {
        if (!$this->_controllerDispatcher) {
            $this->_controllerDispatcher = new Controller\Dispatcher($this->getConfig());
        }
        return $this->_controllerDispatcher;
    }

}
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Application;

use \Gria\Controller;

/**
 * Performs initial checks and kicks off the MVC application. If any problems
 * bubble up to this level, we simply stop script execution and tell the user
 * what is going on.
 */
class Application
{

    /** @var \Gria\Controller\Dispatcher\DispatcherInterface */
    private $controllerDispatcher;

    /**
     * Constructor
     *
     * @param \Gria\Controller\Dispatcher\DispatcherInterface $controllerDispatcher
     */
    public function __construct(Controller\Dispatcher\DispatcherInterface $controllerDispatcher)
    {
        $this->setControllerDispatcher($controllerDispatcher);
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
     * Registers an instance of the controller dispatcher with this object.
     *
     * @param \Gria\Controller\Dispatcher\DispatcherInterface $controllerDispatcher
     */
    public function setControllerDispatcher(Controller\Dispatcher\DispatcherInterface $controllerDispatcher)
    {
        $this->controllerDispatcher = $controllerDispatcher;
    }

    /**
     * Retrieves an instance of the controller dispatcher.
     *
     * @return \Gria\Controller\Dispatcher\DispatcherInterface
     */
    public function getControllerDispatcher()
    {
        return $this->controllerDispatcher;
    }

}
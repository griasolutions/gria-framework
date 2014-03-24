<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

/**
 * Interface defining methods used to dispatch requests to controllers.
 *
 * @package Gria\Controller
 */
interface DispatcherInterface
{

    /**
     * @return void
     */
    public function run();

    /**
     * @param string $controllerName
     * @param \Exception $exception
     * @return \Gria\Controller\ControllerInterface
     */
    public function getController($controllerName, \Exception $exception = null);

} 
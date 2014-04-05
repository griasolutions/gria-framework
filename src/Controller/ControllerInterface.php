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

/**
 * Defines the API for all framework controllers.
 *
 * @package Gria\Controller
 */
interface ControllerInterface
{

    /**
     * Constructor.
     *
     * @param \Gria\Controller\Request\RequestInterface $request
     * @param \Gria\Config\ConfigInterface $config
     * @param \Gria\Helper\Manager $helperManager
     */
    public function __construct(Request\RequestInterface $request, Config\ConfigInterface $config, Helper\Manager $helperManager);

    /**
     * Returns the name of the controller.
     *
     * @return string
     */
    public function getName();

    /**
     * Executes any initialization logic that should be run before the request is dispatched.
     *
     * @return void
     */
    public function init();

    /**
     * Routes a request to the appropriate controller method.
     *
     * @param string $action
     * @return void
     * @throws \Gria\Controller\Exception\InvalidActionException
     */
    public function dispatch($action);

    /**
     * Captures any output generated and registers it with the {@link \Gria\Http\Response\ResponseInterface} object.
     *
     * @return void
     */
    public function render();

    /**
     * Sends the response to the request.
     *
     * @return void
     */
    public function respond();

    /**
     * Returns the {@link \Gria\Http\Response\ResponseInterface} response.
     *
     * @return \Gria\Http\Response\ResponseInterface
     */
    public function getResponse();

}
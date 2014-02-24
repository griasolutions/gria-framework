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

interface ControllerInterface
{

    /**
     * @param \Gria\Http\RequestInterface $request
     * @param \Gria\Config\ConfigInterface $config
     * @param \Gria\Helper\Manager $helperManager
     */
	public function __construct(Http\RequestInterface $request, Config\ConfigInterface $config, Helper\Manager $helperManager);

    /**
     * @return string
     */
    public function getName();

	/**
	 * @return void
	 */
	public function init();

	/**
     * @param string $action
	 * @return void
	 * @throws \Gria\Controller\InvalidActionException
	 */
	public function dispatch($action);

	/**
	 * @return void
	 */
	public function render();

	/**
	 * @return void
	 */
	public function respond();

    /**
     * @param string $key
     * @return \Gria\Helper\HelperInterface
     */
    public function getHelper($key);

	/**
	 * @return \Gria\View\ViewInterface
	 */
	public function getView();

	/**
	 * @return \Gria\Http\ResponseInterface
	 */
	public function getResponse();

}
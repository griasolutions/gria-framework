<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Config;

interface ControllerInterface
{

	/**
	 * @param \Gria\Controller\Request $request
	 * @param \Gria\Config\Config $config
	 */
	public function __construct(Request $request, Config\Config $config);

	/**
	 * @return void
	 */
	public function init();

	/**
	 * @return void
	 * @throws \Gria\Controller\InvalidActionException
	 */
	public function route();

	/**
	 * @return void
	 */
	public function render();

	/**
	 * @return void
	 */
	public function respond();

	/**
	 * @return \Gria\View\View
	 */
	public function getView();

	/**
	 * @return \Gria\Controller\Response
	 */
	public function getResponse();

}
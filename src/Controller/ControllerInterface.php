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

interface ControllerInterface
{

    /**
     * @param \Gria\Controller\Request $request
     * @param \Gria\Config\ConfigInterface $config
     * @param \Gria\Helper\Manager $helperManager
     */
    public function __construct(Request $request, Config\ConfigInterface $config, Helper\Manager $helperManager);

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
     * @return \Gria\Http\ResponseInterface
     */
    public function getResponse();

}
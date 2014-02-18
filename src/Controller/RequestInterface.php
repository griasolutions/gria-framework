<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Http;

interface RequestInterface extends Http\RequestInterface
{

    /**
     * @return string
     */
    public function getControllerName();

    /**
     * @return string
     */
    public function getActionName();

} 
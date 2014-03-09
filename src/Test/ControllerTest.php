<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Test;

use \Gria\Config;
use \Gria\Helper;
use \Gria\Controller;

class ControllerTest extends IntegrationTestAbstract
{

    public function dispatch($uri)
    {
        $this->getMockRequest()->expects($this->any())
            ->method('getUri')
            ->will($this->returnValue($uri));
        $this->setDispatcher($this->getMockRequest());
    }

}
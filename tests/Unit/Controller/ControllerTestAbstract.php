<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Controller;

use Gria\Controller\ControllerInterface;
use \Gria\Helper;

abstract class ControllerTestAbstract extends \PHPUnit_Framework_TestCase
{

    /** @var \Gria\Controller\Request */
    private $_request;

    /** @var \Gria\Controller\Controller */
    private $_controller;

    /** @var \Gria\Helper\Manager */
    private $_helperManager;

    public function setUp()
    {
        $this->_request = $this->getMock('\Gria\Controller\Request', array(
                'getHost', 'getUri', 'getControllerName', 'getActionName'));
        $this->_request->expects($this->any())
            ->method('getHost')
            ->will($this->returnValue('localhost'));
        $this->_helperManager = new Helper\Manager(new Helper\HelperRegistry(), new Helper\AbstractFactory());
    }

    public function setController(ControllerInterface $controller)
    {
        $this->_controller = $controller;
    }

    /**
     * @return \Gria\Controller\Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

    /**
     * @return \Gria\Controller\Controller
     */
    public function getController()
    {
        return $this->_controller;
    }

    /**
     * @return \Gria\Helper\Manager
     */
    public function getHelperManager()
    {
        return $this->_helperManager;
    }

} 
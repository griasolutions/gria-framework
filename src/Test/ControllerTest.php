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

class ControllerTest extends \PHPUnit_Framework_TestCase
{

    private $_config;
    private $_helperManager;
    private $_mockRequest;
    private $_controller;
    private $_dispatcher;

    public function setUp()
    {
        parent::setUp();

        $this->getMock('\IniParser', array('parse'))
            ->expects($this->any())
            ->method('parse')
            ->will($this->returnValue(array(
                        'name' => 'you'
                    )));
        $this->setController(new Controller\Controller($this->getRequest(), $this->getHelperManager(), $this->getConfig()));
    }

    public function testGotHere()
    {
        $this->dispatch('/got/here');
    }

    public function dispatch($uri)
    {
        $this->getMockRequest()->expects($this->any())
            ->method('getUri')
            ->will($this->returnValue($uri));
        $this->setDispatcher($this->getMockRequest());
    }

    public function setDispatcher($mockRequest)
    {
        $this->_dispatcher = new Controller\Dispatcher($mockRequest, $this->getConfig(), $this->getHelperManager());
    }

    /**
     * @return \Gria\Controller\Dispatcher
     */
    public function getDispatcher()
    {
        return $this->_dispatcher;
    }

    public function getMockRequest()
    {
        if (!$this->_mockRequest) {
            $this->_mockRequest = $this->getMock('\Gria\Controller\Request', array(
                    'getHost', 'getUri'));
            $this->_mockRequest->expects($this->any())
                ->method('getHost')
                ->will($this->returnValue('localhost'));
        }
        return $this->_mockRequest;
    }

    public function getHelperManager()
    {
        if (!isset($this->_helperManager)) {
            $this->_helperManager = new Helper\Manager($this->getConfig());
        }
        return $this->_helperManager;
    }

    public function getConfig()
    {
        if (!isset($this->_config)) {
            $path = GRIA_PATH . '/config/application.ini';
            $this->_config = new Config\Config($path);
        }
        return $this->_config;
    }

}
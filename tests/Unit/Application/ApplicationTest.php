<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Application;

use \Gria\Application;
use \Gria\Test;

class ApplicationTest extends Test\UnitTest
{

    /** @var \Gria\Application\Application */
    private $application;

    public function testGetSetControllerDispatcher()
    {
        $config = $this->getMockConfig();
        $config->set('example', 'test');
        $dispatcher = $this->getMockControllerDispatcher();
        $dispatcher->setConfig($config);
        $this->getApplication()->setControllerDispatcher($dispatcher);
        $this->assertEquals($dispatcher, $this->getApplication()->getControllerDispatcher());
    }

    public function testRun()
    {
        $application = $this->getApplication();
        $controllerDispatcher = $application->getControllerDispatcher();
        $controllerDispatcher->expects($this->once())
            ->method('run');
        $this->getApplication()->run();
    }

    /**
     * @return \Gria\Application\Application
     */
    public function getApplication()
    {
        if (!$this->application) {
            $controllerDispatcher = $this->getMockControllerDispatcher();
            $this->application = new Application\Application($controllerDispatcher);
        }
        return $this->application;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\Gria\Controller\Dispatcher\DispatcherInterface
     */
    public function getMockControllerDispatcher()
    {
        $controllerDispatcher = $this->getMock('\Gria\Controller\Dispatcher\Dispatcher',
            array('run'),
            array($this->getMockConfig(), $this->getMockRequest(), $this->getMockHelperManager())
        );
        return $controllerDispatcher;
    }

}
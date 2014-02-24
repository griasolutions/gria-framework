<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Application;

use \Gria\Application;
use \Gria\Config;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{

    /** @var \Gria\Application\Application */
    private $_application;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->getMock('\IniParser', array('parse'))
            ->expects($this->any())
            ->method('parse')
            ->will($this->returnValue(array(
                'name' => 'Test Application'
            )
        ));
        $this->_application = new Application\Application(new Config\Config('example.ini'));
    }

    /**
     * Tests the environment check.
     */
    public function testIsValidEnvironment()
    {
        $this->assertTrue($this->getApplication()->isValidEnvironment());
    }

    /**
     * Tests that a controller dispatcher is returned.
     */
    public function testGetControllerDispatcher()
    {
        $dispatcher = $this->getApplication()->getControllerDispatcher();
        $this->assertInstanceOf('\Gria\Controller\Dispatcher', $dispatcher);
    }

    /**
     * @return \Gria\Application\Application
     */
    public function getApplication()
    {
        return $this->_application;
    }

}
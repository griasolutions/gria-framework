<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Integration\Application;

use \Gria\Application;
use \Gria\Test;

/**
 * Tests {@link \Gria\Application\Application}.
 *
 * @package GriaTest\Integration\Application
 */
class ApplicationTest extends Test\IntegrationTestAbstract
{

    /**
     * Tests {@link \Gria\Application\Application::isValidEnvironment()}.
     */
    public function testIsValidEnvironment()
    {
        $this->assertTrue($this->getApplication()->isValidEnvironment());
    }

    /**
     * Tests {@link \Gria\Application\Application::getControllerDispatcher()}.
     */
    public function testGetControllerDispatcher()
    {
        $dispatcher = $this->getApplication()->getControllerDispatcher();
        $this->assertInstanceOf('\Gria\Controller\Dispatcher', $dispatcher);
    }

    /**
     * Returns an instance of {@link \Gria\Application\Application}.
     *
     * @return \Gria\Application\Application
     */
    public function getApplication()
    {
        $this->_application = new Application\Application($this->getMockConfig());
    }

}
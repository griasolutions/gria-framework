<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Test;

org\bovigo\vfs\vfsStream;

class UnitTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @param array $data
     * @return \PHPUnit_Framework_MockObject_MockObject|\Gria\Config\ConfigInterface
     */
    public function getMockConfig(array $data = [])
    {
        $config = $this->getMock('\Gria\Config\Config',
            array('setPath', 'getData'),
            array($this->getMockFile('example.ini'), $this->getMockEnvironment()));
        $config->expects($this->any())
            ->method('getData')
            ->will($this->returnValue($data));
        return $config;
    }

    public function getMockFile($path, $permissions = '0644')
    {
        return new vfsStream($path, $permissions);
    }

    /**
     * @param string $environmentName
     * @return \PHPUnit_Framework_MockObject_MockObject|\Gria\Application\Environment\EnvironmentInterface
     */
    public function getMockEnvironment($environmentName = GRIA_ENV)
    {
        $environment = $this->getMock('\Gria\Application\Environment\Environment', array('getName'));
        $environment->expects($this->any())
            ->method('getName')
            ->will($this->returnValue($environmentName));
        return $environment;
    }

    /**
     * @param string $uri
     * @param string $host
     * @return \PHPUnit_Framework_MockObject_MockObject|\Gria\Controller\Request\RequestInterface
     */
    public function getMockRequest($uri = '', $host = 'localhost')
    {
        $request = $this->getMock('\Gria\Controller\Request\Request', array('getHost', 'getUri'));
        $request->expects($this->any())
            ->method('getHost')
            ->will($this->returnValue($host));
        $request->expects($this->any())
            ->method('getUri')
            ->will($this->returnValue($uri));
        return $request;
    }

    /**
     * @param array $data
     * @return \PHPUnit_Framework_MockObject_MockObject|\Gria\Helper\Manager\ManagerInterface
     */
    public function getMockHelperManager(array $data = [])
    {
        $config = $this->getMockConfig($data);
        $helperManager = $this->getMock('\Gria\Helper\Manager\Manager', array('getHelper'), array($config));
        return $helperManager;
    }

}
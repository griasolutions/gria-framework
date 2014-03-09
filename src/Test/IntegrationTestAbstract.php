<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Test;

abstract class IntegrationTestAbstract extends \PHPUnit_Framework_TestCase
{

    public function getMockConfig(array $data = [])
    {
        $config = $this->getMock('\Gria\Config\Config', array('getData'));
        $config->expects($this->any())
            ->method('getData')
            ->will($this->returnValue($data));
        return $config;
    }

    public function getMockRequest($uri = '', $host = 'localhost')
    {
        $request = $this->getMock('\Gria\Controller\Request', array('getHost', 'getUri'));
        $request->expects($this->any())
            ->method('getHost')
            ->will($this->returnValue($host));
        $request->expects($this->any())
            ->method('getUri')
            ->will($this->returnValue($uri));
        return $request;
    }

    public function getMockHelperManager(array $data = [])
    {
        $config = $this->getMockConfig($data);
        $helperManager = $this->getMock('\Gria\Helper\Manager', array('getHelper'), array($config));
        return $helperManager;
    }

}
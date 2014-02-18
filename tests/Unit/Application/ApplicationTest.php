<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Application;

class ApplicationTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $this->getMock('\IniParser', array('parse'))
            ->expects($this->any())
            ->method('parse')
            ->will($this->returnValue(array(
                'name' => 'you'
            )
        ));
    }

    /**
     * @expectedException \Gria\Application\InvalidEnvironmentException
     */
    public function testEnvironmentException()
    {
        $path = 'example.ini';
        $application = new \Gria\Application\Application($path);
    }

}
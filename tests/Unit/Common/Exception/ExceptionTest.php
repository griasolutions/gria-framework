<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Common;

use \Gria\Common;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    public function testCode()
    {
        try {
            throw new Common\Exception\Exception('Test');
        } catch (Common\Exception\Exception $ex) {
            $this->assertEquals(500, $ex->getCode());
        }
    }

    public function testMessage()
    {
        try {
            throw new Common\Exception\Exception('Test');
        } catch (Common\Exception\Exception $ex) {
            $this->assertEquals('Test', $ex->getMessage());
        }
    }

}
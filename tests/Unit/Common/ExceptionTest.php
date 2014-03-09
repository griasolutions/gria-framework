<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Common;

use \Gria\Common;

/**
 * Tests the base Exception class.
 *
 * @package GriaTest\Unit\Common
 */
class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests that the correct code is returned.
     *
     * @return void
     */
    public function testCode()
    {
        try {
            throw new Common\Exception('Test');
        } catch (Common\Exception $ex) {
            $this->assertEquals(500, $ex->getCode());
        }
    }

    /**
     * Tests that the correct message is returned.
     *
     * @return void
     */
    public function testMessage()
    {
        try {
            throw new Common\Exception('Test');
        } catch (Common\Exception $ex) {
            $this->assertEquals('Test', $ex->getMessage());
        }
    }

}
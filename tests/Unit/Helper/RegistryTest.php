<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Helper;

use \Gria\Helper;

class RegistryTest extends \PHPUnit_Framework_TestCase
{

    public function testEncodeOffset()
    {
        $registry = new Helper\Registry();
        $registry->offsetSet('TestOffset', 'hey');
        $this->assertTrue($registry->offsetExists('testoffset'));
        $this->assertTrue($registry->offsetExists('TestOffset'));
    }

}
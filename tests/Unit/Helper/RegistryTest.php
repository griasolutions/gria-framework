<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Helper;

use \Gria\Helper;

/**
 * Tests {@link \Gria\Helper\Registry}.
 *
 * @package GriaTest\Unit\Helper
 */
class RegistryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Tests {@link \Gria\Helper\Registry::encodeOffset()}.
     */
    public function testEncodeOffset()
    {
        $registry = new Helper\Registry();
        $offset = 'TestOffset';
        $registry->offsetSet($offset, 'hey');
        $this->assertTrue($registry->offsetExists(strtoupper($offset)));
        $this->assertTrue($registry->offsetExists($offset));
    }

}
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Http;

use \Gria\Http;

class RequestTest extends \PHPUnit_Framework_TestCase
{

    public function testStringConversion()
    {
        $url = 'http://localhost/fake/request';
        $request = new Http\Request($url);
        $this->assertEquals($url, (string) $request);
    }

    public function testUrlParts()
    {
        $url = 'http://guillermo:fisher@localhost/fake/request?a=1&b=foo';
        $request = new Http\Request($url);
        $this->assertEquals('guillermo', $request->getUsername());
        $this->assertEquals('fisher', $request->getPassword());
        $this->assertEquals('localhost', $request->getHost());
        $this->assertEquals('/fake/request', $request->getUri());
        $this->assertEquals('a=1&b=foo', $request->getQuery());
    }

}
 
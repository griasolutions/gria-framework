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

    /** @var string */
    private $_url = 'http://guillermo:fisher@localhost/fake/request?a=1&b=foo';

    /** @var \Gria\Http\RequestInterface */
    private $_request;

    public function setUp()
    {
        $this->_request = new Http\Request($this->getUrl());
    }

    public function testToString()
    {
        $this->assertEquals($this->getUrl(), $this->getRequest()->getUrl());
        $this->assertEquals($this->getUrl(), (string) $this->getRequest());
    }

    public function testGetHost()
    {
        $this->assertEquals('localhost', $this->getRequest()->getHost());
        $request = new Http\Request('http://localhost.com');
        $this->assertEquals('localhost.com', $request->getHost());
    }

    public function testGetPort()
    {
        $this->assertEquals(80, $this->getRequest()->getPort());
        $request = new Http\Request('http://localhost:8080');
        $this->assertEquals(8080, $request->getPort());
    }

    public function testGetUsername()
    {
        $this->assertEquals('guillermo', $this->getRequest()->getUsername());
        $request = new Http\Request('http://localhost');
        $this->assertNull($request->getUsername());
    }

    public function testGetPassword()
    {
        $this->assertEquals('fisher', $this->getRequest()->getPassword());
        $request = new Http\Request('http://localhost');
        $this->assertNull($request->getPassword());
    }

    public function testGetUri()
    {
        $this->assertEquals('/fake/request', $this->getRequest()->getUri());
        $request = new Http\Request('http://localhost');
        $this->assertNull($request->getUri());
    }

    public function testGetUriSegments()
    {
        $this->assertEquals(array('fake', 'request'), $this->getRequest()->getUriSegments());
        $request = new Http\Request('http://localhost');
        $this->assertEquals(array(), $request->getUriSegments());
    }

    public function testGetQuery()
    {
        $this->assertEquals('a=1&b=foo', $this->getRequest()->getQuery());
        $request = new Http\Request('http://localhost');
        $this->assertNull($request->getQuery());
    }

    public function testGetFragment()
    {
        $this->assertNull($this->getRequest()->getFragment());
        $request = new Http\Request('http://localhost/fake#request');
        $this->assertEquals('request', $request->getFragment());
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @return \Gria\Http\RequestInterface
     */
    public function getRequest()
    {
        return $this->_request;
    }

}
 
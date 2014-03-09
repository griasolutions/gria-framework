<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Http;

use \Gria\Http;

/**
 * Tests {@link \Gria\Http\Request}.
 *
 * @package GriaTest\Unit\Http
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{

    /** @var string */
    private $_url = 'http://guillermo:fisher@localhost/fake/request?a=1&b=foo';

    /** @var \Gria\Http\RequestInterface */
    private $_request;

    /**
     * @inheritdoc
     */
    public function setUp()
    {
        $this->_request = new Http\Request($this->getUrl());
    }

    /**
     * Tests {@link \Gria\Http\Request::__toString()}.
     *
     * @return void
     */
    public function testToString()
    {
        $this->assertEquals($this->getUrl(), $this->getRequest()->getUrl());
        $this->assertEquals($this->getUrl(), (string)$this->getRequest());
    }

    /**
     * Tests {@link \Gria\Http\Request::getHost()}.
     *
     * @return void
     */
    public function testGetHost()
    {
        $this->assertEquals('localhost', $this->getRequest()->getHost());
        $request = new Http\Request('http://localhost.com');
        $this->assertEquals('localhost.com', $request->getHost());
    }

    /**
     * Tests {@link \Gria\Http\Request::getPort()}.
     *
     * @return void
     */
    public function testGetPort()
    {
        $this->assertEquals(80, $this->getRequest()->getPort());
        $request = new Http\Request('http://localhost:8080');
        $this->assertEquals(8080, $request->getPort());
    }

    /**
     * Tests {@link \Gria\Http\Request::getUsername()}.
     *
     * @return void
     */
    public function testGetUsername()
    {
        $this->assertEquals('guillermo', $this->getRequest()->getUsername());
        $request = new Http\Request('http://localhost');
        $this->assertNull($request->getUsername());
    }

    /**
     * Tests {@link \Gria\Http\Request::getPassword()}.
     *
     * @return void
     */
    public function testGetPassword()
    {
        $this->assertEquals('fisher', $this->getRequest()->getPassword());
        $request = new Http\Request('http://localhost');
        $this->assertNull($request->getPassword());
    }

    /**
     * Tests {@link \Gria\Http\Request::getUri()}.
     *
     * @return void
     */
    public function testGetUri()
    {
        $this->assertEquals('/fake/request', $this->getRequest()->getUri());
        $request = new Http\Request('http://localhost');
        $this->assertNull($request->getUri());
    }

    /**
     * Tests {@link \Gria\Http\Request::getUriSegments()}.
     *
     * @return void
     */
    public function testGetUriSegments()
    {
        $this->assertEquals(array('fake', 'request'), $this->getRequest()->getUriSegments());
        $request = new Http\Request('http://localhost');
        $this->assertEquals(array(), $request->getUriSegments());
    }

    /**
     * Tests {@link \Gria\Http\Request::getQuery()}.
     *
     * @return void
     */
    public function testGetQuery()
    {
        $this->assertEquals('a=1&b=foo', $this->getRequest()->getQuery());
        $request = new Http\Request('http://localhost');
        $this->assertNull($request->getQuery());
    }

    /**
     * Tests {@link \Gria\Http\Request::getFragment()}.
     *
     * @return void
     */
    public function testGetFragment()
    {
        $this->assertNull($this->getRequest()->getFragment());
        $request = new Http\Request('http://localhost/fake#request');
        $this->assertEquals('request', $request->getFragment());
    }

    /**
     * Returns the url.
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * Returns an instance of {@link \Gria\Http\RequestInterface}.
     *
     * @return \Gria\Http\RequestInterface
     */
    public function getRequest()
    {
        return $this->_request;
    }

}
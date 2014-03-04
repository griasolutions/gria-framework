<?php

namespace GriaTest\Unit\Controller;

use \Gria\Controller;

class RequestTest extends \PHPUnit_Framework_TestCase
{

    private $_request;

    public function setUp()
    {
        $this->_request = new Controller\Request('http://localhost/test');
    }

    public function testSomething()
    {
        $this->markTestSkipped();
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->_request;
    }

} 
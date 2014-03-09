<?php

namespace GriaTest\Integration\Controller;

class RequestTest extends \PHPUnit_Framework_TestCase
{

    public function testIsGet()
    {
        $this->markTestSkipped();
        $request = $this->getMock('\Gria\Controller\Request', array('getServer'));
    }


}
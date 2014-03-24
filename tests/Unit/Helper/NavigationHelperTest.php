<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GriaTest\Unit\Helper;

use \Gria\Test;
use \Gria\Helper;

class NavigationHelperTest extends Test\UnitTest
{

    /** @var \Gria\Helper\NavigationHelper */
    private $_navigationHelper;

    /** @var array */
    private $_fixtureData = array(
        array(
            'label' => 'First Page',
            'action' => 'page1',
            'controller' => 'page1',
            'title' => 'This is the first page',
            'active' => true
        ),
        array(
            'label' => 'Second Page',
            'action' => 'page2',
            'controller' => 'page2',
            'class' => 'example',
            'title' => 'This is the second page'
        )
    );

    public function setUp()
    {
        $config = $this->getMockConfig();
        $this->_navigationHelper = new Helper\NavigationHelper($config);
    }

    public function testSetMenuItems()
    {
        $expectedData = $this->getFixtureData();
        $this->getNavigationHelper()->setMenuItems($expectedData);
        $this->assertEquals($expectedData, $this->getNavigationHelper()->getMenuItems());
    }

    public function testAddMenuItems()
    {
        $newMenuItem = array(
            'label' => 'Third Page',
            'action' => 'page3',
            'controller' => 'page3',
            'title' => 'This is the third page'
        );
        $this->getNavigationHelper()
            ->setMenuItems($this->getFixtureData())
            ->addMenuItems($newMenuItem);
        $expectedData = $this->getFixtureData();
        $expectedData[] = $newMenuItem;
        $this->assertEquals($expectedData, $this->getNavigationHelper()->getMenuItems());
    }

    public function testRemoveMenuItems()
    {
        $this->getNavigationHelper()
            ->setMenuItems($this->getFixtureData())
            ->removeMenuItems(['action' => 'page1']);
        $expectedData = [array_pop($this->getFixtureData())];
        $this->assertEquals($expectedData, $this->getNavigationHelper()->getMenuItems());
    }

    public function testSetMenuContainer()
    {
        $expectedData = 'nav';
        $this->getNavigationHelper()->setMenuContainer($expectedData);
        $this->assertEquals($expectedData, $this->getNavigationHelper()->getMenuContainer());
    }

    public function testSetMenuContainerAttributes()
    {
        $expectedData = array();
        $this->getNavigationHelper()->setMenuContainerAttributes($expectedData);
        $this->assertEquals($expectedData, $this->getNavigationHelper()->getMenuContainerAttributes());
    }

    public function testRender()
    {
        $expectedData = '<nav><ul>'
            . '<li class="active">'
            . '<a href="/page1/page1" title="This is the first page">First Page</a>'
            . '</li>'
            . '<li class="example">'
            . '<a href="/page2/page2" title="This is the second page">Second Page</a>'
            . '</li>'
            . '</ul></nav>';
        $this->getNavigationHelper()
            ->setMenuContainer('nav')
            ->setMenuItems($this->getFixtureData());
        $this->assertEquals($expectedData, $this->getNavigationHelper()->render());
    }

    public function getNavigationHelper()
    {
        return $this->_navigationHelper;
    }

    public function getFixtureData()
    {
        return $this->_fixtureData;
    }

}
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

class HtmlHelperTest extends Test\UnitTest
{

    private $_htmlHelper;

    public function testCreateAnchorElement()
    {
        $data = array(
            'label' => 'First Page',
            'href' => '/example/page',
            'title' => 'This is the first page',
        );
        $expectedValue = '';
        $this->assertEquals($expectedValue, $this->getHtmlHelper()->createAnchorElement($data));
    }

    public function getHtmlHelper()
    {
        return $this->_htmlHelper;
    }

} 
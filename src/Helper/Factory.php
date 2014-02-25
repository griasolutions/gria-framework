<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper;

use \Gria\Common;

class AbstractFactory implements Common\AbstractFactoryInterface
{

    /**
     * @param string $name
     * @return \Gria\Helper\HelperInterface
     */
    public function get($name)
    {
        $className = '\Application\Helper\\' . $name;
        if (class_exists($className)) {
            $helper = new $className;
            return $helper;
        }
    }

}
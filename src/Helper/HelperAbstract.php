<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper;

use \Gria\Config;

class HelperAbstract implements HelperInterface
{

    use Config\ConfigAwareTrait;

    /** @var string */
    private $_name;

    /**
     * @inheritdoc
     */
    public function __construct(Config\ConfigInterface $config)
    {
        $this->_name = get_class($this);
        $this->setConfig($config);
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return $this->_name;
    }

} 
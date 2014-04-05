<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Config;

/**
 * Defines the API for classes that are aware of instances of the {@link \Gria\Config\ConfigInterface} interface.
 *
 * @package Gria\Common
 */
trait ConfigAwareTrait
{

    /** @var \Gria\Config\ConfigInterface * */
    private $config;

    /**
     * Registers the provided {@link \Gria\Config\ConfigInterface} with this class.
     *
     * @param \Gria\Config\ConfigInterface $config
     * @return $this
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;
        return $this;
    }

    /**
     * Returns the instance of {@link \Gria\Config\ConfigInterface} registered with this class.
     *
     * @return \Gria\Config\ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

}
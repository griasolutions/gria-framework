<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Config;

use \Gria\Common;
use \Gria\Application\Environment;

interface ConfigInterface extends Common\Registry\RegistryInterface
{

    /**
     * @see \Gria\Application\Environment\EnvironmentAwareTrait::setEnvironment()
     */
    public function setEnvironment(Environment\EnvironmentInterface $environment);

    /**
     * @see \Gria\Application\Environment\EnvironmentAwareTrait::getEnvironment()
     */
    public function getEnvironment();

    /**
     * Sets the path of the configuration file.
     *
     * @throws \Gria\Config\Exception\InvalidConfigException
     * @param string $path
     * @return \Gria\Config\ConfigInterface
     */
    public function setPath($path);

    /**
     * Returns the path of the configuration file.
     *
     * @return string
     */
    public function getPath();

    /**
     * Enables or disables modification of the class.
     *
     * @param bool $isEnabled
     * @return \Gria\Config\ConfigInterface
     */
    public function enableModification($isEnabled);

    /**
     * Whether or not modifications are allowed.
     *
     * @return bool
     */
    public function isModificationEnabled();

}
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Config;

use \Gria\Common;

class Config extends Common\Registry implements ConfigInterface
{

    /** @var string */
    private $_path;

    /**
     * Constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        $this->setPath($path);
    }

    /**
     * Sets the path of the configuration file.
     *
     * @param string $path
     * @return \Gria\Config\Config
     */
    public function setPath($path)
    {
        $this->_path = realpath($path);
        $rawData = (new \IniParser($this->_path))->parse();
        foreach ($rawData as $environment => $settings) {
            if (GRIA_ENV == trim($environment)) {
                foreach ($settings as $key => $value) {
                    $this->set($key, $value);
                }
                break;
            }
        }
        return $this;
    }

    /**
     * Returns the path of the configuration file.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->_path;
    }

}
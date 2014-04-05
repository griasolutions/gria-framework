<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Config;

use \Gria\Application\Environment;
use \Gria\Common;

class Config extends Common\Registry\Registry implements ConfigInterface
{

    use Environment\EnvironmentAwareTrait;

    /** @var bool */
    private $modificationEnabled = true;

    /** @var string */
    private $path;

    /**
     * Constructor.
     *
     * @param string $path
     * @param \Gria\Application\Environment\EnvironmentInterface $environment
     */
    public function __construct($path, Environment\EnvironmentInterface $environment)
    {
        $this->setEnvironment($environment);
        $this->setPath($path);
        $this->enableModification(false);
    }

    /**
     * @inheritdoc
     */
    public function setPath($path)
    {
        if (!$this->path = realpath($path)) {
            $message = sprintf('%s is not a valid config path.', $path);
            throw new Exception\InvalidConfigException($message);
        }
        $rawData = (new \IniParser($this->path))->parse();
        foreach ($rawData as $environment => $settings) {
            if ($this->getEnvironment()->getName() == trim($environment)) {
                foreach ($settings as $key => $value) {
                    $this->set($key, $value);
                }
                break;
            }
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @inheritdoc
     */
    public function offsetSet($offset, $value)
    {
        if ($this->isModificationEnabled()) {
            return parent::offsetSet($offset, $value);
        }
    }

    /**
     * @inheritdoc
     */
    public function enableModification($isEnabled)
    {
        if (is_bool($isEnabled)) {
            $this->modificationEnabled = $isEnabled;
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function isModificationEnabled()
    {
        return $this->modificationEnabled;
    }

}
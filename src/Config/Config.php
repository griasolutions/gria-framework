<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Config;

class Config implements ConfigInterface
{

	/** @var string */
	private $_path;

    /** @var array */
    private $_rawData = [];

	/** @var array */
	private $_data = [];

    /**
     * @param string $path
     */
    public function __construct($path = '')
	{
        if ($path) {
			$this->setPath(realpath($path));
		}
	}

    /**
     * @inheritdoc
     */
    public function get($key)
    {
        $data = $this->getData();
        if (array_key_exists($key, $data)) {
            return $data[$key];
        }
    }

	/**
	 * @return array
	 */
	public function getData()
	{
		if (!$this->_data) {
			$data = $this->getRawData();
			foreach ($data as $environment => $settings) {
				if (GRIA_ENV == trim($environment)) {
					$this->_data = $settings;
					break;
				}
			}
		}
		return $this->_data;
	}

    /**
     * @return array
     */
    public function getRawData()
    {
        if (!isset($this->_rawData)) {
            $this->_rawData = (new \IniParser($this->getPath()))->parse();
        }
        return $this->_rawData;
    }

	/**
	 * @param string $path
     * @return \Gria\Config\Config
	 */
	public function setPath($path)
	{
		$this->_path = $path;
        return $this;
	}

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->_path;
	}

}
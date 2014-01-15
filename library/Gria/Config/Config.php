<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Config;

class Config
{

	/** @var string */
	private $_path;

	/** @var array */
	private $_data = array();

	/**
	 * @param string $path
	 * @return \Gria\Config\Config
	 */
	public function __construct($path = '')
	{
		if ($path) {
			$this->setPath(realpath($path));
		}
	}

	/**
	 * @return array
	 */
	public function getData()
	{
		if (!$this->_data) {
			$data = (new \IniParser($this->getPath()))->parse();
			foreach ($data as $environment => $settings) {
				if (APPLICATION_ENV == trim($environment)) {
					$this->_data = $settings;
					break;
				}
			}
		}
		return $this->_data;
	}

	/**
	 * @param string $path
	 */
	public function setPath($path)
	{
		$this->_path = $path;
	}

	/**
	 * @return string
	 */
	public function getPath()
	{
		return $this->_path;
	}

	/**
	 * @param $key
	 * @return mixed
	 */
	public function get($key)
	{
		$data = $this->getData();
		if (array_key_exists($key, $data)) {
			return $data[$key];
		}
	}

}
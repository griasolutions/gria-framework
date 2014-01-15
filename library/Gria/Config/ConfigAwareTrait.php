<?php

namespace Gria\Config;

trait ConfigAwareTrait
{

	/** @var \Gria\Config\Config * */
	private $_config;

	/**
	 * @param \Gria\Config\Config $config
	 *
	 * @return $this
	 */
	public function setConfig(Config $config)
	{
		$this->_config = $config;

		return $this;
	}

	/**
	 * @return \Gria\Config\Config
	 */
	public function getConfig()
	{
		return $this->_config;
	}

}

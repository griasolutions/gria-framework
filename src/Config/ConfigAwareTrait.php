<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Config;

trait ConfigAwareTrait
{

	/** @var \Gria\Config\Config * */
	private $_config;

	/**
	 * @param \Gria\Config\ConfigInterface $config
	 * @return $this
	 */
	public function setConfig(ConfigInterface $config)
	{
		$this->_config = $config;
		return $this;
	}

	/**
	 * @return \Gria\Config\ConfigInterface
	 */
	public function getConfig()
	{
		return $this->_config;
	}

}

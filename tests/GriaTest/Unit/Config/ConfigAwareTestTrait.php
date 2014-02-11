<?php

namespace GriaTest\Unit\Config;

use \Gria\Config;

trait ConfigAwareTestTrait
{

	/** @var \Gria\Config\Config */
	private $_config;

	public function setUp()
	{
		$path = 'tests/fixtures/config/test.ini';
		$this->_config = new Config\Config($path);
	}

	/**
	 * @return \Gria\Config\Config
	 */
	public function getConfig()
	{
		return $this->_config;
	}

} 
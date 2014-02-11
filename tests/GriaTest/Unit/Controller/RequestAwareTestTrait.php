<?php

namespace GriaTest\Unit\Controller;

use \Gria\Config;
use GriaTest\Unit\Config\ConfigAwareTestTrait;

trait RequestAwareTestTrait
{

	use ConfigAwareTestTrait {
		setUp as configTraitSetup;
	}

	/** @var \Gria\Controller\Request */
	private $_request;

	public function setUp()
	{
		$this->configTraitSetup();
		$this->_request = $this->getMock('\Gria\Controller\Request', array(
			'getHost', 'getUri', 'getControllerName', 'getActionName'));
		$this->_request->expects($this->any())
			->method('getHost')
			->will($this->returnValue('localhost'));
	}

	/**
	 * @return \Gria\Controller\Request
	 */
	public function getRequest()
	{
		return $this->_request;
	}

	/**
	 * @return \Gria\Config\Config
	 */
	public function getConfig()
	{
		return $this->_config;
	}

} 
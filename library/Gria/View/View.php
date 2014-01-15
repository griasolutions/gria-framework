<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\View;

use \Gria\Controller;
use \Gria\Config;

class View
{

	use Controller\RequestAwareTrait, Config\ConfigAwareTrait;

	const VIEW_BASE_PATH = 'src/application/templates';

	/** @var string */
	private $_sourcePath;

	/** @var array */
	private $_settings = array();

	/**
	 * @param \Gria\Controller\Request $request
	 * @param \Gria\Config\Config $config
	 */
	public function __construct(Controller\Request $request, Config\Config $config)
	{
		$this->setRequest($request);
		$this->setConfig($config);
		$this->init();
	}

	/**
	 * @return void
	 */
	public function init()
	{
		$this->set('controllerName', $this->getRequest()->getControllerName());
		$this->set('actionName', $this->getRequest()->getActionName());
	}

	/**
	 * @param string $sourcePath
	 */
	public function setSourcePath($sourcePath)
	{
		$this->_sourcePath = $sourcePath;
	}

	/**
	 * @return string
	 */
	public function getSourcePath()
	{
		return $this->_sourcePath;
	}

	/**
	 * @param string $key
	 * @param string $value
	 */
	public function set($key, $value)
	{
		$this->_settings[$key] = $value;
	}

	/**
	 * @param string $key
	 * @return mixed
	 */
	public function get($key)
	{
		if (array_key_exists($key, $this->_settings)) {
			return $this->_settings[$key];
		}
	}

	/**
	 * @return string
	 */
	public function render()
	{
		return $this->_renderTemplate('views/' . $this->getSourcePath());
	}

	/**
	 * @param string $partial
	 * @return string
	 */
	public function renderPartial($partial)
	{
		return $this->_renderTemplate('partials/' . $partial);
	}

	/**
	 * @param string $templateName
	 * @throws \Gria\View\InvalidTemplateException
	 * @return string
	 */
	private function _renderTemplate($templateName)
	{
		ob_start();
		@include self::VIEW_BASE_PATH . '/' . $templateName . '.phtml';
		if (!$output = ob_get_clean()) {
			throw new InvalidTemplateException(sprintf('%s is not a valid template', $templateName));
		}

		return $output;
	}

} 
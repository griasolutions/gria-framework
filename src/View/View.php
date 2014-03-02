<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\View;

use \Gria\Controller;
use \Gria\Config;
use \Gria\Helper;

class View implements ViewInterface
{

	use Config\ConfigAwareTrait, Helper\HelperManagerAwareTrait;

	const VIEW_BASE_PATH = 'src/application/views';

    const VIEW_FILE_EXTENSION = 'phtml';

	/** @var string */
	private $_sourcePath;

	/** @var array */
	private $_settings = array();

    /**
     * @param \Gria\Config\ConfigInterface $config
     * @param \Gria\Helper\Manager $helperManager
     */
	public function __construct(Config\ConfigInterface $config, Helper\Manager $helperManager)
	{
		$this->setConfig($config);
        $this->setHelperManager($helperManager);
	}

	/**
	 * @inheritdoc
	 */
	public function setSourcePath($sourcePath)
	{
		$this->_sourcePath = $sourcePath;
	}

    /**
     * @inheritdoc
     */
	public function getSourcePath()
	{
		return $this->_sourcePath;
	}

    /**
     * @inheritdoc
     */
	public function set($key, $value)
	{
		$this->_settings[$key] = $value;
	}

    /**
     * @inheritdoc
     */
	public function get($key)
	{
		if (array_key_exists($key, $this->_settings)) {
			return $this->_settings[$key];
		}
	}

    /**
     * @inheritdoc
     */
	public function render()
	{
		return $this->_renderTemplate('layouts/' . $this->getSourcePath());
	}

    /**
     * @inheritdoc
     */
	public function renderPartial($partial)
	{
		return $this->_renderTemplate('partials/' . $partial);
	}

	/**
	 * @param string $templateName
	 * @throws \Gria\View\InvalidViewException
	 * @return string
	 */
	private function _renderTemplate($templateName)
	{
		$path = GRIA_PATH . '/' . static::VIEW_BASE_PATH . '/' . $templateName . '.'
            . static::VIEW_FILE_EXTENSION;
		if (!file_exists($path)) {
            $errorMessage = sprintf('%s is not a valid template', $path);
            throw new InvalidViewException($errorMessage);
		}
        ob_start();
        include $path;
        $output = ob_get_clean();
		return $output;
	}

} 
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Config;

class Request implements RequestInterface
{

    use Config\ConfigAwareTrait;

	/** @var string */
	private $_host;

	/** @var string */
	private $_uri;

	/** @var array */
	private $_uriSegments = [];

	/** @var string */
	private $_url;

	/** @var string */
	private $_controllerName;

	/** @var string */
	private $_actionName;

    /**
     * @param Config\ConfigInterface $config
     */
    public function __construct(Config\ConfigInterface $config)
    {
        $this->setConfig($config);
    }

	/**
	 * @return string
	 */
	public function __toString()
	{
		return $this->getUrl();
	}

	/**
	 * @inheritdoc
	 */
	public function getHost()
	{
		if (!$this->_host) {
			$this->_host = filter_input(INPUT_SERVER, 'HTTP_HOST');
		}

		return $this->_host;
	}

	/**
	 * @inheritdoc
	 */
	public function getUri()
	{
		if (!$this->_uri) {
			$this->_uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
		}

		return $this->_uri;
	}

	/**
	 * @inheritdoc
	 */
	public function getUrl()
	{
		if (!$this->_url) {
			$this->_url = 'http://' . $this->getHost() . $this->getUri();
		}

		return $this->_url;
	}

    /**
     * @inheritdoc
     */
	public function getControllerName()
	{
		if (!$this->_controllerName) {
			$uriSegments = $this->_getUriSegments();
            if (!isset($uriSegments[0]) || $uriSegments[0] == '') {
                $routes = $this->getConfig()->get('routes');
                $defaultController = isset($routes['defaultController']) ? $routes['defaultController'] : 'index';
                $this->_controllerName = $defaultController;
			} else {
				$this->_controllerName = strtolower($uriSegments[0]);
			}
		}

		return $this->_controllerName;
	}

    /**
     * @inheritdoc
     */
	public function getActionName()
	{
		if (!$this->_actionName) {
			$uriSegments = $this->_getUriSegments();
            if (!isset($uriSegments[1]) || $uriSegments[1] == '') {
                $routes = $this->getConfig()->get('routes');
                $defaultAction = isset($routes['defaultAction']) ? $routes['defaultAction'] : 'index';
                $this->_actionName = $defaultAction;
            } else {
                $this->_actionName = strtolower($uriSegments[1]);
            }

		}

		return $this->_actionName;
	}

    /**
     * @return array
     */
	private function _getUriSegments()
	{
		if (!$this->_uriSegments) {
			$uriSegments = explode('/', $this->getUri());
			array_shift($uriSegments);
			$this->_uriSegments = $uriSegments;
		}

		return $this->_uriSegments;
	}

}
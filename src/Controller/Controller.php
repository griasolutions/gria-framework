<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\View;
use \Gria\Config;
use \Gria\Helper;
use \Gria\Http;

class Controller implements ControllerInterface
{

	use Http\RequestAwareTrait, Config\ConfigAwareTrait, Helper\HelperManagerAwareTrait;

	/** @var string */
    private $_name;

    /** @var \Gria\View\View */
	private $_view;

	/** @var \Gria\Http\ResponseInterface */
	private $_response;

	/**
	 * @inheritdoc
	 */
	public function __construct(Http\RequestInterface $request, Config\ConfigInterface $config, Helper\Manager $helperManager)
	{
	    $this->_name = strtolower(get_class($this));
		$this->setRequest($request);
		$this->setConfig($config);
        $this->setHelperManager($helperManager);
		$this->_response = new Http\Response();
		$this->_view = new View\View($this->getConfig());
		$this->init();
	}

    /**
     * @return string
     */
    public function getName()
    {
        return $this->_name;
    }

	/**
	 * @inheritdoc
	 */
	public function init()
	{
	}

	/**
	 * @inheritdoc
	 */
	public function dispatch($action)
	{
        $actionMethodName = $action . 'Action';
		if (!method_exists($this, $actionMethodName)) {
			throw new InvalidActionException(sprintf('%s is not a valid action', $action));
		}
		$this->$actionMethodName();
	}

	/**
	 * @return void
	 */
	public function indexAction()
	{
	}

	/**
	 * @inheritdoc
	 */
	public function render()
	{
		if (!$this->getView()->getSourcePath()) {
			$className = strtolower(get_called_class());
			$this->getView()->setSourcePath(array_pop(explode('\\', $className)));
		}
		$this->getResponse()->setBody($this->getView()->render());
	}

	/**
	 * @inheritdoc
	 */
	public function respond()
	{
		$this->getResponse()->send();
	}

    /**
     * @inheritdoc
     */
    public function getHelper($key)
    {
        return $this->getHelperManager()->get($key);
    }

	/**
	 * @inheritdoc
	 */
	public function getView()
	{
		return $this->_view;
	}

	/**
	 * @inheritdoc
	 */
	public function getResponse()
	{
		return $this->_response;
	}

}
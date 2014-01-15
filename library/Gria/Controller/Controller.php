<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\View;
use \Gria\Config;

class Controller implements ControllerInterface
{

	use RequestAwareTrait, Config\ConfigAwareTrait;

	/** @var \Gria\View\View */
	private $_view;

	/** @var \Gria\Controller\Response */
	private $_response;

	/**
	 * @inheritdoc
	 */
	public function __construct(Request $request, Config\Config $config)
	{
		$this->setRequest($request);
		$this->setConfig($config);
		$this->_response = new Response();
		$this->_view = new View\View($this->getRequest(), $this->getConfig());
		$this->init();
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
	public function route()
	{
		$actionMethodName = $this->getRequest()->getActionName() . 'Action';
		if (!method_exists($this, $actionMethodName)) {
			throw new InvalidActionException(sprintf('%s is not a valid action', $actionMethodName));
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
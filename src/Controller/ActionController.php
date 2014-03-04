<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\View;

class ActionController extends ControllerAbstract
{

    /** @var \Gria\View\View */
    private $_view;

    /** @var bool */
    private $_enableView = true;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setView(new View\View($this->getConfig(), $this->getHelperManager()));
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
     * @inheritdoc
     */
    public function render()
    {
        $output = '';
        if ($this->isViewEnabled() && !$this->getView()->getSourcePath()) {
            $className = strtolower(get_called_class());
            $this->getView()->setSourcePath(array_pop(explode('\\', $className)));
            $output = $this->getView()->render();
        }
        $this->getResponse()->setStatusCode(200);
        $this->getResponse()->setBody($output);
    }

    /**
     * @return void
     */
    public function indexAction()
    {
    }

    public function disableView()
    {
        $this->_enableView = false;
    }

    public function isViewEnabled()
    {
        return $this->_enableView;
    }

    /**
     * @param View\View $view
     * @return void
     */
    public function setView(View\View $view)
    {
        $this->_view = $view;
    }

    /**
     * @return \Gria\View\ViewInterface
     */
    public function getView()
    {
        return $this->_view;
    }

}
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use Gria\Http\Response;
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
        $output = '';
        if ($this->isViewEnabled()) {
            $className = strtolower(get_called_class());
            $this->getView()->setPath(array_pop(explode('\\', $className)));
            $output = $this->getView()->render();
        }
        $this->getResponse()->setStatusCode(200);
        $this->getResponse()->setBody($output);
    }

    /**
     * Enables the view.
     *
     * @return void
     */
    public function enableView()
    {
        $this->_enableView = true;
    }

    /**
     * Disables the view.
     *
     * @return void
     */
    public function disableView()
    {
        $this->_enableView = false;
    }

    /**
     * Returns the status of the view.
     *
     * @return bool
     */
    public function isViewEnabled()
    {
        return $this->_enableView;
    }

    /**
     * Registers the view with this controller.
     *
     * @param \Gria\View\View $view
     * @return \Gria\Controller\ActionController
     */
    public function setView(View\View $view)
    {
        $this->_view = $view;
        return $this;
    }

    /**
     * Returns the view.
     *
     * @return \Gria\View\View
     */
    public function getView()
    {
        return $this->_view;
    }

}
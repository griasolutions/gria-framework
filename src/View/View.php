<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\View;

use \Gria\Common;
use \Gria\Controller;
use \Gria\Config;
use \Gria\Helper;

class View extends Common\Registry implements ViewInterface
{

    use Config\ConfigAwareTrait, Helper\HelperManagerAwareTrait;

    /** @var string */
    private $_path;

    /** @var string */
    private $_defaultBasePath = 'src/application/views/layouts';

    /** @var string */
    private $_defaultExtension = 'phtml';

    /**
     * @param \Gria\Config\ConfigInterface $config
     * @param \Gria\Helper\Manager $helperManager
     * @param array $data
     */
    public function __construct(Config\ConfigInterface $config, Helper\Manager $helperManager, array $data = [])
    {
        $this->setConfig($config);
        $this->setHelperManager($helperManager);
        parent::__construct($data);
        $this->_defaultBasePath = GRIA_PATH . '/' . $this->_defaultBasePath;
    }

    /**
     * @see \Gria\View\View::render()
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * @inheritdoc
     */
    public function render()
    {
        if (!ob_start('ob_gzhandler')) {
            ob_start();
        }
        $path = $this->getPath();
        if (!file_exists($path)) {
            $errorMessage = sprintf('%s is not a valid view file.', $path);
            throw new InvalidViewException($errorMessage);
        }
        include $path;
        $content = ob_get_clean();
        return $content;
    }

    /**
     * @inheritdoc
     */
    public function setPath($path)
    {
        $viewConfig = $this->getConfig()->get('view');
        $basePath = isset($viewConfig['basePath']) ? $viewConfig['basePath'] : $this->getDefaultBasePath();
        $extension = isset($viewConfig['extension']) ? $viewConfig['extension'] : $this->getDefaultExtension();
        $this->_path = sprintf('%s/%s.%s', $basePath, $path, $extension);
    }

    /**
     * @inheritdoc
     */
    public function getPath()
    {
        return $this->_path;
    }

    /**
     * Returns the default base path to the view files.
     *
     * @return string
     */
    public function getDefaultBasePath()
    {
        return $this->_defaultBasePath;
    }

    /**
     * Returns the default view file extension.
     *
     * @return string
     */
    public function getDefaultExtension()
    {
        return $this->_defaultExtension;
    }

    /**
     * @param $path
     */
    public function loadPartial($path)
    {
        /** @var $partialHelper \Gria\View\PartialHelper */
        $partialHelper = $this->getHelperManager()->getHelper('partial');
        $partialHelper->load($path);
    }

}
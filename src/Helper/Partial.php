<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper;

use \Gria\Config;

class PartialHelper extends HelperAbstract
{

    /** @var string */
    private $_defaultBasePath = 'src/application/views/partials';

    /** @var string */
    private $_defaultExtension = 'phtml';

    /**
     * @inheritdoc
     */
    public function __construct(Config\ConfigInterface $config)
    {
        parent::__construct($config);
        $this->_defaultBasePath = GRIA_PATH . '/' . $this->_defaultBasePath;
    }

    /**
     * @param $path
     */
    public function load($path)
    {
        $viewConfig = $this->getConfig()->get('view');
        $basePath = isset($viewConfig['basePath']) ? $viewConfig['basePath'] : $this->getDefaultBasePath();
        $extension = isset($viewConfig['extension']) ? $viewConfig['extension'] : $this->getDefaultExtension();
        if ($fullPath = realpath(sprintf('%s/%s.%s', $basePath, $path, $extension))) {
            include $fullPath;
        }

    }

    /**
     * Returns the default base path to the partial files.
     *
     * @return string
     */
    public function getDefaultBasePath()
    {
        return $this->_defaultBasePath;
    }

    /**
     * Returns the default partial file extension.
     *
     * @return string
     */
    public function getDefaultExtension()
    {
        return $this->_defaultExtension;
    }

} 
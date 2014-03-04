<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper;

trait HelperManagerAwareTrait
{

    /** @var \Gria\Helper\Manager */
    private $_helperManager;

    /**
     * @param string $key
     * @return null|\Gria\Helper\HelperInterface
     */
    public function getHelper($key)
    {
        return $this->getHelperManager()->get($key);
    }

    /**
     * @param Manager $helperManager
     * @return $this
     */
    public function setHelperManager(Manager $helperManager)
    {
        $this->_helperManager = $helperManager;

        return $this;
    }

    /**
     * @return \Gria\Helper\Manager
     */
    public function getHelperManager()
    {
        return $this->_helperManager;
    }

} 
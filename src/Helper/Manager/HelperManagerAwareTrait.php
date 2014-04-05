<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Helper\Manager;

trait HelperManagerAwareTrait
{

    /** @var \Gria\Helper\Manager\ManagerInterface */
    private $helperManager;

    /**
     * @param string $key
     * @return null|\Gria\Helper\HelperInterface
     */
    public function getHelper($key)
    {
        return $this->getHelperManager()->get($key);
    }

    /**
     * @param \Gria\Helper\Manager\ManagerInterface $helperManager
     * @return $this
     */
    public function setHelperManager(ManagerInterface $helperManager)
    {
        $this->helperManager = $helperManager;

        return $this;
    }

    /**
     * @return \Gria\Helper\Manager\ManagerInterface
     */
    public function getHelperManager()
    {
        return $this->helperManager;
    }

} 
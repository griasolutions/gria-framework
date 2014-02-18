<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\View;

interface ViewInterface
{

    /**
     * @param string $sourcePath
     */
    public function setSourcePath($sourcePath);

    /**
     * @return string
     */
    public function getSourcePath();

    /**
     * @param string $key
     * @param string $value
     */
    public function set($key, $value);

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * @return string
     */
    public function render();

    /**
     * @param string $partial
     * @return string
     */
    public function renderPartial($partial);

}
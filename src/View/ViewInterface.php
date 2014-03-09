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
     * Renders the view.
     *
     * @return string
     */
    public function render();

    /**
     * Sets the path to the view file.
     *
     * @param string $path
     * @return \Gria\View\ViewInterface
     */
    public function setPath($path);

    /**
     * Returns the path to the view file.
     *
     * @return string
     */
    public function getPath();

}
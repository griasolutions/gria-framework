<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Http;

interface RequestInterface
{

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return string
     */
    public function getUri();

    /**
     * @return string
     */
    public function getUrl();

}
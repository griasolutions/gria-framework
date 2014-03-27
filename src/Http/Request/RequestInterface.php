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
    public function getUrl();

    /**
     * @return string
     */
    public function getHost();

    /**
     * @return string
     */
    public function getPort();

    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return string
     */
    public function getUri();

    /**
     * @return array
     */
    public function getUriSegments();

    /**
     * @return string
     */
    public function getQuery();

    /**
     * @return string
     */
    public function getFragment();

}
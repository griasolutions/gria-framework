<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Http;

interface ResponseInterface
{

    /**
     * @param string $header
     */
    public function addHeader($header);

    /**
     * @return array
     */
    public function getHeaders();

    /**
     * @param string $statusCode
     */
    public function setStatusCode($statusCode);

    /**
     * @param string $contentType
     */
    public function setContentType($contentType);

    /**
     * @param string $body
     */
    public function setBody($body);

    /**
     * @return string
     */
    public function getBody();

    /**
     * @return void
     */
    public function send();

}
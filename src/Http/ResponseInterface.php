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
     * @return \Gria\Http\ResponseInterface
     */
    public function setStatusCode($statusCode);

    /**
     * @param string $contentType
     * @return \Gria\Http\ResponseInterface
     */
    public function setContentType($contentType);

    /**
     * @param string $body
     * @return \Gria\Http\ResponseInterface
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
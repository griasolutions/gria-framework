<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Http\Response;

class Response implements ResponseInterface
{

    /** @var int */
    private $_statusCode;

    /** @var array */
    private static $_statusCodes = [
        200 => 'OK',
        301 => 'Moved Permanently',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error'
    ];

    /** @var array */
    private $_headers = [];

    /** @var string */
    private $_body;

    /**
     * @inheritdoc
     */
    public function addHeader($header)
    {
        $this->_headers[] = $header;
    }

    /**
     * @inheritdoc
     */
    public function getHeaders()
    {
        return $this->_headers;
    }

    /**
     * @inheritdoc
     */
    public function setStatusCode($statusCode)
    {
        if (array_key_exists($statusCode, static::$_statusCodes)) {
            $this->addHeader('HTTP/1.0 ' . $statusCode . ' ' . static::$_statusCodes[$statusCode]);
            $this->_statusCode = $statusCode;
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    /**
     * @inheritdoc
     */
    public function setContentType($contentType)
    {
        $this->addHeader('Content-Type: ' . $contentType);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function setBody($body)
    {
        $this->_body = $body;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getBody()
    {
        return $this->_body;
    }

    /**
     * @inheritdoc
     */
    public function send()
    {
        $headers = $this->getHeaders();
        foreach ($headers as $header) {
            header($header);
        }
        echo $this->getBody();
        exit;
    }

}
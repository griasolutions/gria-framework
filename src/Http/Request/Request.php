<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Http\Request;

class Request implements RequestInterface
{

    /** @var string */
    private $_url;

    /** @var string */
    private $_host;

    /** @var string */
    private $_port;

    /** @var string */
    private $_username;

    /** @var string */
    private $_password;

    /** @var string */
    private $_uri;

    /** @var array */
    private $_uriSegments;

    /** @var string */
    private $_query;

    /** @var string */
    private $_fragment;

    /**
     * Constructor
     */
    public function __construct($url)
    {
        $this->_url = $url;
        $this->_host = parse_url($url, PHP_URL_HOST);
        $this->_port = parse_url($url, PHP_URL_PORT) ? : 80;
        $this->_username = parse_url($url, PHP_URL_USER);
        $this->_password = parse_url($url, PHP_URL_PASS);
        $this->_uri = parse_url($url, PHP_URL_PATH);
        $this->_uriSegments = explode('/', $this->_uri);
        array_shift($this->_uriSegments);
        $this->_query = parse_url($url, PHP_URL_QUERY);
        $this->_fragment = parse_url($url, PHP_URL_FRAGMENT);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getUrl();
    }

    /**
     * @inheritdoc
     */
    public function getUrl()
    {
        return $this->_url;
    }

    /**
     * @inheritdoc
     */
    public function getHost()
    {
        return $this->_host;
    }

    /**
     * @inheritdoc
     */
    public function getPort()
    {
        return $this->_port;
    }

    /**
     * @inheritdoc
     */
    public function getUsername()
    {
        return $this->_username;
    }

    /**
     * @inheritdoc
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @inheritdoc
     */
    public function getUri()
    {
        return $this->_uri;
    }

    /**
     * @return array
     */
    public function getUriSegments()
    {
        return $this->_uriSegments;
    }

    /**
     * @inheritdoc
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * @inheritdoc
     */
    public function getFragment()
    {
        return $this->_fragment;
    }

}
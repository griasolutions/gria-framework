<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

use \Gria\Http;

class Request extends Http\Request
{

    /** @var array */
    private $_put;

    /** @var array */
    private $_delete;

    /**
     * @inheritdoc
     */
    public function __construct()
    {
        $protocol = ($this->getServer('HTTPS') ? 'https' : 'http') . '://';
        $url = $protocol . $this->getServer('HTTP_HOST') . $this->getServer('REQUEST_URI');
        parent::__construct($url);
        if ($this->getContentType() == 'application/x-www-form-urlencoded' && ($this->isPut() || $this->isDelete())) {
            $data = file_get_contents('php://input');
            if ($this->isPut()) {
                parse_str($data, $this->_put);
            } else {
                parse_str($data, $this->_delete);
            }
        }
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return $this->getServer('REQUEST_METHOD') == 'GET';
    }

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->getServer('REQUEST_METHOD') == 'POST';
    }

    /**
     * @return bool
     */
    public function isPut()
    {
        return $this->getServer('REQUEST_METHOD') == 'PUT';
    }

    /**
     * @return bool
     */
    public function isDelete()
    {
        return $this->getServer('REQUEST_METHOD') == 'DELETE';
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getGet($param)
    {
        return filter_input(INPUT_GET, $param);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getPost($param)
    {
        return filter_input(INPUT_POST, $param);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getPut($param)
    {
        if (isset($this->_put[$param])) {
            return filter_var($this->_put[$param]);
        }
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getDelete($param)
    {
        if (isset($this->_delete[$param])) {
            return filter_var($this->_delete[$param]);
        }
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getServer($param)
    {
        return filter_input(INPUT_SERVER, $param);
    }

    /**
     * @param $param
     * @return mixed
     */
    public function getEnv($param)
    {
        return filter_input(INPUT_ENV, $param);
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->getServer('CONTENT_TYPE');
    }

}
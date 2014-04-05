<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller\Request;

use \Gria\Http;

class Request extends Http\Request\Request implements RequestInterface
{

    /** @var array */
    private $put;

    /** @var array */
    private $delete;

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
                parse_str($data, $this->put);
            } else {
                parse_str($data, $this->delete);
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function isGet()
    {
        return $this->getServer('REQUEST_METHOD') == 'GET';
    }

    /**
     * @inheritdoc
     */
    public function isPost()
    {
        return $this->getServer('REQUEST_METHOD') == 'POST';
    }

    /**
     * @inheritdoc
     */
    public function isPut()
    {
        return $this->getServer('REQUEST_METHOD') == 'PUT';
    }

    /**
     * @inheritdoc
     */
    public function isDelete()
    {
        return $this->getServer('REQUEST_METHOD') == 'DELETE';
    }

    /**
     * @inheritdoc
     */
    public function getGet($param)
    {
        return filter_input(INPUT_GET, $param);
    }

    /**
     * @inheritdoc
     */
    public function getPost($param)
    {
        return filter_input(INPUT_POST, $param);
    }

    /**
     * @inheritdoc
     */
    public function getPut($param)
    {
        if (isset($this->put[$param])) {
            return filter_var($this->put[$param]);
        }
    }

    /**
     * @inheritdoc
     */
    public function getDelete($param)
    {
        if (isset($this->delete[$param])) {
            return filter_var($this->delete[$param]);
        }
    }

    /**
     * @inheritdoc
     */
    public function getServer($param)
    {
        return filter_input(INPUT_SERVER, $param);
    }

    /**
     * @inheritdoc
     */
    public function getEnv($param)
    {
        return filter_input(INPUT_ENV, $param);
    }

    /**
     * @inheritdoc
     */
    public function getContentType()
    {
        return $this->getServer('CONTENT_TYPE');
    }

}
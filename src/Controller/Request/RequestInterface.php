<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller\Request;

use \Gria\Http;

interface RequestInterface extends Http\Request\RequestInterface
{
    /**
     * @return bool
     */
    public function isGet();

    /**
     * @return bool
     */
    public function isPost();

    /**
     * @return bool
     */
    public function isPut();

    /**
     * @return bool
     */
    public function isDelete();

    /**
     * @param $param
     * @return mixed
     */
    public function getGet($param);

    /**
     * @param $param
     * @return mixed
     */
    public function getPost($param);

    /**
     * @param $param
     * @return mixed
     */
    public function getPut($param);

    /**
     * @param $param
     * @return mixed
     */
    public function getDelete($param);

    /**
     * @param $param
     * @return mixed
     */
    public function getServer($param);

    /**
     * @param $param
     * @return mixed
     */
    public function getEnv($param);

    /**
     * @return mixed
     */
    public function getContentType();

}
<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Http\Request;

trait RequestAwareTrait
{

    /** @var \Gria\Http\Request\RequestInterface */
    private $_request;

    /**
     * @param \Gria\Http\Request\RequestInterface $request
     * @return $this
     */
    public function setRequest(RequestInterface $request)
    {
        $this->_request = $request;
        return $this;
    }

    /**
     * @return \Gria\Http\Request\RequestInterface
     */
    public function getRequest()
    {
        return $this->_request;
    }

}
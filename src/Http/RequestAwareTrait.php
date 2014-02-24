<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Http;

trait RequestAwareTrait
{

    /** @var \Gria\Http\RequestInterface */
    private $_request;

    /**
     * @param \Gria\Http\RequestInterface $request
     * @return $this
     */
    public function setRequest(RequestInterface $request)
    {
        $this->_request = $request;
        return $this;
    }

    /**
     * @return \Gria\Http\RequestInterface
     */
    public function getRequest()
    {
        return $this->_request;
    }

}
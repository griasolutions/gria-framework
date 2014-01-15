<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

trait RequestAwareTrait
{

	/** @var \Gria\Controller\Request */
	private $_request;

	/**
	 * @param \Gria\Controller\Request $request
	 *
	 * @return $this
	 */
	public function setRequest(Request $request)
	{
		$this->_request = $request;

		return $this;
	}

	/**
	 * @return \Gria\Controller\Request
	 */
	public function getRequest()
	{
		return $this->_request;
	}

} 
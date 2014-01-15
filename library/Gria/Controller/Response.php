<?php
/**
 * This file is part of the Gria library.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Controller;

class Response
{

	/** @var array */
	public static $statusCodes = array(
		200 => 'OK',
		301 => 'Moved Permanently',
		403 => 'Forbidden',
		404 => 'Not Found',
		500 => 'Internal Server Error'
	);

	/** @var array */
	private $_headers = array();

	/** @var string */
	private $_body;

	/**
	 * @param string $header
	 */
	public function addHeader($header)
	{
		$this->_headers[] = $header;
	}

	/**
	 * @return array
	 */
	public function getHeaders()
	{
		return $this->_headers;
	}

	/**
	 * @param string $statusCode
	 */
	public function setStatusCode($statusCode)
	{
		if (array_key_exists($statusCode, self::$statusCodes)) {
			$this->addHeader('HTTP/1.0 ' . $statusCode . ' ' . self::$statusCodes[$statusCode]);
		}
	}

	/**
	 * @param string $contentType
	 */
	public function setContentType($contentType)
	{
		$this->addHeader('Content-Type: ' . $contentType);
	}

	/**
	 * @param string $body
	 */
	public function setBody($body)
	{
		$this->_body = $body;
	}

	/**
	 * @return string
	 */
	public function getBody()
	{
		return $this->_body;
	}

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
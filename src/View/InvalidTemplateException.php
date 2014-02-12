<?php

namespace Gria\View;

class InvalidTemplateException extends \Exception
{

	/**
	 * @inheritdoc
	 */
	public function __construct($message = "", $code = 0, \Exception $previous = null)
	{
		parent::__construct($message, 500, $previous);
	}

} 
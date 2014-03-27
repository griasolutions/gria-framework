<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Gria\Common\Exception;

/**
 * Exception interface.
 *
 * @package Gria\Common\Exception
 */
interface ExceptionInterface
{

    /**
     * Returns the exception's error message.
     *
     * @return string
     */
    public function getMessage();

    /**
     * Returns the exception's error code.
     *
     * @return int
     */
    public function getCode();

}
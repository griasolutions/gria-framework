<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

define('GRIA_ENV', 'development');

if (php_sapi_name() !== 'cli-server' || file_exists(__DIR__ . '/public/' . $_SERVER['REQUEST_URI'])) {
    return false;
}

require dirname(__DIR__) . '/bootstrap.php';
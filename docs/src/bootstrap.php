<?php
/**
 * This file is part of the Gria Framework package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

// define the application environment
defined('GRIA_ENV') or die('Please set the application environment!');

// timezone
defined('GRIA_TIMEZONE') or define('GRIA_TIMEZONE', 'America/New_York');
date_default_timezone_set(GRIA_TIMEZONE);

// define the path to the files
defined('GRIA_PATH') or define('GRIA_PATH', dirname(__DIR__));

// set the include path
set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    GRIA_PATH,
    dirname(GRIA_PATH)
)));

// pull in composer dependencies from the framework
require 'vendor/autoload.php';

if (GRIA_ENV == 'development') {
    ini_set('display_errors', true);
}

// run the application
call_user_func(function(){
    $config = new \Gria\Config\Config(GRIA_PATH . '/config/application.ini');
    $request = new \Gria\Controller\Request();
    $helperManager = new \Gria\Helper\Manager($config);
    $controllerDispatcher = new \Gria\Controller\Dispatcher($config, $request, $helperManager);
    (new \Gria\Application\Application($controllerDispatcher))->run();
});
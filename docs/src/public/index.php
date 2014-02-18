<?php

// timezone
date_default_timezone_set('America/New_York');

// define the application environment
defined('GRIA_ENV') || define('GRIA_ENV', 'production');

// define the path to the files
define('GRIA_PATH', dirname(dirname(dirname(__FILE__))));

// set the include path
set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    GRIA_PATH,
    dirname(dirname(GRIA_PATH))
)));

// pull in composer dependencies
require 'vendor/autoload.php';

// run the application
$path = GRIA_PATH . '/config/application.ini';
(new \Gria\Application\Application(new \Gria\Config\Config($path)))->run();
<?php

// set the include path
set_include_path(implode(PATH_SEPARATOR, array(
	get_include_path(),
	dirname(dirname(__FILE__)),
)));

// define the path to the fixtures directory
define('GRIA_FIXTURE_DIR', dirname(__FILE__) . '/fixtures');

// pull in composer dependencies
require 'vendor/autoload.php';
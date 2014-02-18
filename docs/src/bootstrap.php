<?php

if (php_sapi_name() !== 'cli-server') {
    return false;
}

ini_set('display_errors', true);
if (file_exists(__DIR__ . '/public/' . $_SERVER['REQUEST_URI'])) {
    return false;
} else {
    include_once 'public/index.php';
}
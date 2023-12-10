<?php

namespace App;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR | E_PARSE | E_NOTICE);

define('ROOT_DIR', dirname(__DIR__));

require_once ROOT_DIR . '/config/autoload.php';
require_once ROOT_DIR . '/app/web.php';

$app = new App();

$app->run();

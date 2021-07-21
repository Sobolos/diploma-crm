<?php

use app\core\libs\db\db;
use app\core\Router;

require 'Dev.php';
$db_settings = require 'app/core/libs/db/db_config.php';

spl_autoload_register(function ($class){
    $path = str_replace('\\', '/', $class.'.php');
    if(file_exists($path))
    {
        require $path;
    }
});

session_start();

$db = new db($db_settings['db']);
$router = new Router();
$router->start();
<?php
chdir(dirname(__DIR__));
require 'vendor/autoload.php';

$configFile = 'config/config.php';
$config = include $configFile;

$app = new App\Application($config);
$app->run();

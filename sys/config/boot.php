<?php
$autoloader = require '/home/blackmesa/www/.railsphp/vendor/autoload.php';

Rails::boot([
    'loader' => [
        'composerAutoloader' => $autoloader
    ]
]);

if (!isset($railsEnv)) {
    $railsEnv = 'development';
}

$config = [
    'environment' => $railsEnv,
    'root'        => dirname(__DIR__),
    'paths' => [
        'public_path'  => __DIR__ . '/../..'
    ]
];

$railsApp = Rails::loadApplication('NewApp', $config);

<?php
$autoloader = require __DIR__ . '/../vendor/autoload.php';

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
    'root'        => dirname(__DIR__)
];

$railsApp = Rails::loadApplication('NewApp', $config);

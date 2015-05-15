<?php

Yii::setAlias('@tests', dirname(__DIR__) . '/tests');

if (getenv('APP_ENV') == 'development') {
    define('ENV', 'dev');
    error_reporting(error_reporting() & ~E_NOTICE);
    $configName = 'dev.php';
} elseif (getenv('APP_ENV') == 'production') {
    define('ENV', 'prod');
    error_reporting(0);
    ini_set('display_errors', 0);
    $configName = 'prod.php';
} else {
    define('ENV', 'local');
    ini_set('display_errors', 'on');
    error_reporting(E_ALL & ~E_NOTICE);
    $configName = 'local.php';
}


$params = require(__DIR__ . '/params.php');
$db = require(__DIR__ . '/db.php');

return yii\helpers\ArrayHelper::merge([
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'gii'],
    'controllerNamespace' => 'app\commands',
    'modules' => [
        'gii' => 'yii\gii\Module',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
    ],
    'params' => $params,
], require(__DIR__ . DIRECTORY_SEPARATOR . $configName));

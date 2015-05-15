<?php

$params = require(__DIR__ . '/params.php');

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

$environmentConfig = require(__DIR__ . DIRECTORY_SEPARATOR . $configName);

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'ru',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'hRBOxx3w',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return yii\helpers\ArrayHelper::merge($config, $environmentConfig);

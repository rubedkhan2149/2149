<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$baseUrl = str_replace('/backend/web', '/backend', (new \yii\web\Request)->getBaseUrl());

return [
    'id' => 'Admin',
    'defaultRoute' => 'auth/login',
    'homeUrl' => 'dashboard/index',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
         'auth' => [
            'class' => 'backend\modules\auth\Auth',
        ],
        
     ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => ['auth/login'],
        ],
        'request' => [
            'baseUrl' => $baseUrl
        ],
        
        'urlManagerFrontEnd' => [
            'class' => 'yii\web\urlManager',
            'baseUrl' => '/exampeep/frontend/web/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];

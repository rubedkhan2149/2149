<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php'),
   require(__DIR__ . '/../../common/config/constant.php')        
);

use \yii\web\Request;

$baseUrl = str_replace('/frontend/web', '', (new Request)->getBaseUrl());

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    
    'modules' => [
        'auth' => [
            'class' => 'frontend\modules\auth\AuthModule',
        ],
        'user' => [
            'class' => 'frontend\modules\user\User',
        ],     

    ],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
      'user' => [
            'class' => 'common\components\WebUser',
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => array('auth/login')
        ],  
      'request' => [
            'baseUrl' => $baseUrl,
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
        
        'urlManager' => [
            'baseUrl' => $baseUrl,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => []
        ]
        
    ],
    'params' => $params,
];

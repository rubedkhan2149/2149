<?php

namespace backend\components;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;

use Yii;

class Controller extends \yii\web\Controller
{
    public function behaviors() 
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'except'=> ['login','error','logout'],
                'rules' => [
                    [
                      'allow' => Yii::$app->user->isAdmin,
                    ],
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
   
} 
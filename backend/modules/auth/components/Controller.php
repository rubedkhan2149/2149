<?php

namespace backend\modules\auth\components;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;


class Controller extends \yii\web\Controller
{
    public function behaviors() 
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login','forgot-password','reset-password'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    
   
} 
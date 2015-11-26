<?php
namespace frontend\components;

use yii;
use yii\base\Behavior;
use yii\filters\AccessControl;

class Controller extends yii\web\Controller 
{
    public $layout='main';
    
    public function behaviors()
    {
        
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['index','affiliate-list','create','update','leads','lead-list','leadupdate'],
                'rules' => [
                    // allow authenticated users
                    [
                        'allow' => true,
                        'matchCallback' => function(){
                                                return Yii::$app->user->isUser;
                                        } 
                    ],
                    // everything else is denied by default
                ],
            ],
        ];
    
    
    }
    
    
}
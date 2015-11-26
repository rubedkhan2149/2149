<?php

namespace common\components;
use Yii;
use yii\web\User;

class WebUser extends User{
    
    
    public function getIsAdmin()
    {
       return (!empty(\Yii::$app->user->identity) && \Yii::$app->user->identity->user_type == 'admin') ? true:false;
    }
    public function getIsUser()
    {
       return (!empty(\Yii::$app->user->identity) && \Yii::$app->user->identity->user_type == 'user') ? true:false;
    }
    
    public function getId()
    {
            if(!empty (\Yii::$app->user->identity->Id))
                return  \Yii::$app->user->identity->Id;
            else
                return false;
    }
    
    public function handleError($event)
    {
        if ($event instanceof CExceptionEvent) {
            return $this->renderPartial('@app/views/site/error',['exception'=>Yii::$app->errorHandler->exception]);
        } elseif ($event instanceof CErrorEvent) {
            return $this->renderPartial('@app/views/site/error',['exception'=>Yii::$app->errorHandler->exception]);
        }
        $event->handled = TRUE;
    }  
    
}

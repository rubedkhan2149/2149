<?php

namespace frontend\controllers;
use Yii;
class HomeController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        return $this->render('home');
    }

}

<?php
namespace frontend\modules\user\controllers;
use yii\web\Controller;
class DashboardController extends Controller
{
    public $layout = "main";
    public function actionIndex()
    {
        return $this->render('index');
    }
}

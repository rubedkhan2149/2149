<?php

namespace backend\controllers;

class DashboardController extends \backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}

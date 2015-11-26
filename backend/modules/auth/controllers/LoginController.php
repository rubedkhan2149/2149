<?php
namespace backend\modules\auth\controllers;


use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Cookie;
use yii\web\NotFoundHttpException;
use common\models\LoginForm;
use common\models\Users;
use common\components\Utility;
use common\models\PasswordResetRequestForm;
use common\models\ResetPasswordForm;

class LoginController extends \backend\modules\auth\components\Controller
{
   
    public $defaultAction = 'login';
    
    public function actions() 
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex() 
    {

        return $this->render('index');
    }

    public function actionLogin()
    {
        if(\Yii::$app->user->isAdmin)
        {
            return $this->goHome();
        }
        $model = new LoginForm();
        $model->role='admin';
        if ($model->load(Yii::$app->request->post()) && $model->login())
        {
           return $this->redirect(['/dashboard']);
        } 
       
        return $this->render('login', [
                    'model' => $model,
            ]);
    }

    public function actionLogout()
    {
        \yii::$app->user->logout();
        return $this->redirect(['/auth/login']);
    }
    
    public function actionForgotPassword()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return Yii::$app->getResponse()->redirect(['/auth/login/login']);
            } 
            else
            {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('forgotpassword', [
                    'model' => $model,
        ]);
    }
    
    public function actionResetPassword($token)
    {
        try
        {
            $model = new ResetPasswordForm($token);
        }
        catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }
        
        if($model->load(Yii::$app->request->post()) && $model->validate()&& $model->resetPassword()) 
        {
           Yii::$app->getSession()->setFlash('success', 'Password has been changed successfully.');
           return $this->redirect(['/auth/login']);
        }
        return $this->render('resetpassword', [
                    'model' => $model,
        ]);
    }
}

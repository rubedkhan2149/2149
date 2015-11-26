<?php

namespace frontend\modules\auth\controllers;
use Yii;
use common\components\WebUser;
use common\models\LoginForm;
use common\models\User;
use common\models\UserDetail;
use yii\widgets\ActiveForm;
use yii\web\JsonParser;
use yii\web\Response;
use frontend\models\ResetPasswordForm;
//use frontend\models\PasswordResetRequestForm;
use common\models\PasswordResetRequestForm;
class LoginController extends \yii\web\Controller
{
   
    public function actionIndex()
    {
        if(empty(Yii::$app->user->identity->id))
        {
            $model = new LoginForm(); 
            $model->role='user';
            if($model->load(Yii::$app->request->post()))    
            {
                if(Yii::$app->request->isAjax)
                {    
                    $this->layout = null;
                    Yii::$app->response->format = Response::FORMAT_JSON;
                    return ActiveForm::validate($model);
                }
                if($model->validate() && $model->login())
                {
                    return $this->redirect(['/user/dashboard']);  
                }
            }   
            return $this->render('login',array('model'=>$model));
        }
        else
        {
            return $this->redirect(array('/home'));  
        }
    }
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');
                return $this->redirect(['/auth/login']);
            } 
            else
            {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Your password has been reset successfully.');
            return $this->redirect(array('/auth/login/')); 
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect(array('/auth/login'));
    } 
}

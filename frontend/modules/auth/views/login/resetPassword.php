<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

$this->title = 'Reset password';
//$this->params['breadcrumbs'][] = $this->title;
?>




<div class="container login-page">
  <div class="row">
    <div class="col-lg-6 col-sm-6 col-xs-12 col-sm-offset-3">
        
   <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
        
        
        
     <div class="well well-lg">
          <?= Alert::widget() ?>
            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
        <h4><?= Html::encode($this->title) ?></h4>
        <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'confirm_password')->passwordInput() ?>
                 </div>
     
     <div class="form-group">
                    <?= Html::submitButton('Save', ['class' => 'btn btn-info']) ?>
     </div>
        
            <?php ActiveForm::end(); ?>
   </div>
  </div>
 </div>
</div>

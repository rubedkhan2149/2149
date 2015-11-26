<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */
$this->title = 'Reset Password';
$this->params['breadcrumbs'][] = $this->title;
?>

<main class="reset-container">
<div class="container">
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
<div class="row">
<div class="site-request-password-reset">
  <h1><?= Html::encode($this->title) ?></h1>
    <p>Please fill out your email. A link to reset password will be sent there.</p>
    
        <?php if(Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php endif; ?>
    
    
      <div class="row">
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
                <?= $form->field($model, 'email') ?>
                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-success m-t-10']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
      </div>
</div>
</div>
</div>

</div>
</main>
<?php
//use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\url;
//
///* @var $this \yii\web\View */
///* @var $content string */
//
//AppAsset::register($this);
?>
<?php //$this->beginPage() ?>
<!--<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>Admin Login</title>
    <?php $this->head() ?>
</head>
<body>-->
    <?php //$this->beginBody() ?>
    
    
    
    <section class="adminloginpage">
    <div class="container">
    	<div class="row">
    	    <div class="col-xs-12">
        	    <div class="form-wrap">
                        <img class="img-responsive center-block m-b-20" src="<?php echo yii::$app->urlManagerFrontEnd->baseUrl?>/images/logo.jpg" />
                <h1>Admin Login</h1>                  
                          <?php if (Yii::$app->session->hasFlash('success')): ?>
                                            <div class="alert alert-success" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <?= Yii::$app->session->getFlash('success') ?>
                                            </div>
                                        <?php endif; ?> 
                            <?php $form = ActiveForm::begin([
                                'id' => 'login-form', 
                                'enableAjaxValidation' => false, 
                                'enableClientValidation' => true
                            ]); ?>
                            <div class="form-group">
                                <?php //echo $form->field($model, 'username')->begin();?>
                                <label for="email">UserName<span class="color-red">*</span></label>
                                <?php 
                                echo Html::activeTextInput($model, 'username',['class' => 'form-control input-lg','placeholder'=>'']); //field
                                echo Html::error($model,'username', ['id' => 'username','class' => 'errorMessage']); //error
                                //echo $form->field($model, 'username')->end();
                                ?>
                            </div>
                            <div class="form-group">
                                <?php //echo $form->field($model, 'password')->begin();?>
                                <label for="key" >Password<span class="color-red">*</span></label>
                                 <?php 
                                    echo Html::activePasswordInput($model, 'ud_password',['class' => 'form-control input-lg','placeholder'=>'']); //field
                                    echo Html::error($model,'ud_password', ['id' => 'password','class' => 'errorMessage']); //error
                                    //echo $form->field($model, 'password')->end();
                                ?>
                            </div>

                            <?php 
                            //echo $form->field($model, 'role')->begin();
                            echo Html::activeHiddenInput($model, 'role',['class' => 'form-control','placeholder'=>'', 'value'=>1]); //field
                            //echo $form->field($model, 'role')->end();
                            ?>

                            <?= Html::submitButton('Log In', ['class' => 'btn btn-primary btn-lg', 'name' => 'login-button']) ?>

                            <?php ActiveForm::end(); ?>
                            <div class="form-group">
                            <a href="<?php echo yii::$app->urlManager->createUrl(['/auth/login/forgot-password'])?>">Forgot your password? </a>
                         </div>
                            
                        </div>
                        </div>                
                   
        	    </div>
    		</div> <!-- /.col-xs-12 -->
    	
</section>
    

    <?php //$this->endBody() ?>
<!--</body>
</html>-->
<?php //$this->endPage() ?>

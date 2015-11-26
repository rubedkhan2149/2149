<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;
$this->title='Forgot Password';
?>

<section class="adminloginpage">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <img class="img-responsive center-block m-b-20" src="<?php echo yii::$app->urlManagerFrontEnd->baseUrl ?>/images/logo.jpg" />
                    <h3 class="text-center">Have you forgotten your password?</h3>               
                            <?php $form = ActiveForm::begin(); ?>
                            <div class="form-group"> 
                                 <?= $form->field($model, 'email')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Email'])->label(false) ?>
                            </div> 
    
                            <div class="form-group m-b-20">
                                <button type="submit" class="btn btn-primary btn-lg">Send</button>
                            </div>
    
                            <?php ActiveForm::end(); ?>



                </div>
            </div>                

        </div>
    </div> <!-- /.col-xs-12 -->

</section>

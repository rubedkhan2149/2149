<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\widgets\Alert;
$this->title = 'Reset password';
?>
<script>
    $(document).ready(function(){
        $('#resetpasswordform-password').val('');
    });
</script>

<section class="adminloginpage">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="form-wrap">
                    <img class="img-responsive center-block m-b-20" src="<?php echo yii::$app->urlManagerFrontEnd->baseUrl ?>/images/logo.jpg" />
                    <h3 class="text-center">Reset password</h3>             
                        <?php $form = ActiveForm::begin([
                                            'options' =>['autocomplete' => 'off' ],
                                     ]);?>
                        <div class="form-group requrd_inner">
                          <input type="text" style="display:none;"> <!--  just to avoid autfill-->
                            <?= $form->field($model, 'password')->passwordInput(['class' => 'form-control bg-password', 'placeholder' => 'New Password'])->label(false) ?>
                        </div> 

                        <div class="form-group requrd_inner">
                            <input type="text" style="display:none;"> <!--  just to avoid autfill-->
                            <?= $form->field($model, 'confirm_password')->passwordInput(['class' => 'form-control bg-password', 'placeholder' => 'Confirm Password'])->label(false); ?>
                        </div>   
                        <div class="form-group m-b-20">
                            <button type="submit" class="btn btn-info">Save</button>
                        </div>
                        <?php ActiveForm::end(); ?>  

                </div>
            </div>                

        </div>
    </div> <!-- /.col-xs-12 -->

</section>

<div class="clearfix"></div>  

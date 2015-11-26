<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Coupon;
use yii\helpers\Url;
$this->title = 'Manage Coupons';
?>
<script src="<?php echo YII::getAlias("@js_url"); ?>/bootstrap-select.js"></script>
<link rel="stylesheet" href="<?php echo Yii::getAlias("@css_url") ?>/jquery-ui.min.css">
<script src="<?php echo Yii::getAlias("@js_url") ?>/jquery-ui.min.js"></script>
<script>
    $().ready(function(){
       $( "#coupon-end_date" ).datepicker({
               minDate: 'today',
           }); 
    });
    $('.selectpicker').selectpicker();
</script>   
<article class="common_dahboardform shareexam_form">
    <?php $form = ActiveForm::begin([
                    'id' => 'coupon-form', 
                    'enableAjaxValidation' => false, 
                    'enableClientValidation' => true
                ]); ?>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8">
        <div class="form-group"> 
            <label>Coupon Name <span style="color:red"> *</span></label>
            <?php 
              echo Html::activeTextInput($coupons, 'name',['class' => 'form-control input-lg','placeholder'=>'Coupon Name']); //field
              echo Html::error($coupons,'name', ['id' => 'name','class' => 'errorMessage help-block']); //error
            ?>
        </div>
        <div class="form-group"> 
            <label>Coupon Code <span style="color:red"> *</span></label>
            <?php 
              echo Html::activeTextInput($coupons, 'code',['class' => 'form-control input-lg','placeholder'=>'Coupon Code']); //field
              echo Html::error($coupons,'code', ['id' => 'name','class' => 'errorMessage help-block']); //error
            ?>
            <p class="help-block"><small>The code the customer enters to get the discount </small></p>
        </div>
        <div class="form-group"> 
            <label>Discount <span style="color:red"> *</span></label>
            <?php 
              echo Html::activeTextInput($coupons, 'discount',['class' => 'form-control input-lg','placeholder'=>'Discount']); //field
              echo Html::error($coupons,'discount', ['id' => 'discount','class' => 'errorMessage help-block']); //error
            ?>
        </div>
        <div class="form-group"> 
            <label>Uses Per Coupon <span style="color:red"> *</span></label>
            <?php 
              echo Html::activeTextInput($coupons, 'uses_total',['class' => 'form-control input-lg','placeholder'=>'User Per Coupon']); //field
              echo Html::error($coupons,'uses_total', ['id' => 'uses_total','class' => 'errorMessage help-block']); //error
            ?>
            <p class="help-block"><small>The maximum number of times the coupon can be used by any customer. Leave blank for unlimited.</small></p>
        </div>
        <div class="form-group"> 
            <label>End Date <span style="color:red"> *</span></label>
            <?php 
              echo Html::activeTextInput($coupons, 'end_date',['class' => 'form-control input-lg','placeholder'=>'']); //field
              echo Html::error($coupons,'end_date', ['id' => 'end_date','class' => 'errorMessage help-block']); //error
            ?>
        </div>
        <div class="form-group"> 
            <label>Status <span style="color:red"> *</span></label>
            <select class="selectpicker form-group" name="coupon-status">
                <option value="active">Enabled</option>
                <option value="inactive">Disabled</option>
            </select>
        </div>
        </div>
    </div>
        <div class="clearfix"></div>
        <div class="form-group m-t-10 m-b-0">
            <button type="submit" class="btn btn-primary" >Submit</button>&nbsp;&nbsp;
        </div> 
    <?php ActiveForm::end(); ?>
</article> 
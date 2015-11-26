<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\MasterCategory;
use yii\helpers\Url;

?>
<script src="<?php echo YII::getAlias("@js_url"); ?>/bootstrap-select.js"></script>
<script>
    $('.selectpicker').selectpicker();
     
    function saveCoupon()
    {
        categoryName = $("#mastercategory-category_name").val();
        flag = 0;
        if(couponName=='')
        {
            $("#category_name").html("Coupon name cannot be blank.");
            flag++;
        }
        if(flag==0)
        {
            $.ajax({
               url      : "<?php echo Url::toRoute("/category/add-category"); ?>",
               type     : 'post',
               data     : $("#category-form").serialize(),
               dataType: "json",
               success  : function(data){
                   if(data.response=='error')
                   {
                       $("#category_name").html(data.message);
                   }
               }
            });
        }
    }     
</script>   
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <img src="<?php echo Yii::getAlias('@images_url'); ?>/closemodal-icon.png" alt="close"/></button>
            <h4 class="modal-title" id="myModalLabel">Add Categories</h4>
        </div>      
        <div class="modal-body">
              <?php $form = ActiveForm::begin([
                            'id' => 'category-form', 
                            'enableAjaxValidation' => false, 
                            'enableClientValidation' => true
                        ]); ?>
                <div class="form-group"> 
                    <label>Category Name <span style="color:red"> *</span></label>
                        <?php 
                          echo Html::activeTextInput($masterCategory, 'category_name',['class' => 'form-control input-lg','placeholder'=>'']); //field
                          echo Html::error($masterCategory,'category_name', ['id' => 'category_name','class' => 'errorMessage help-block']); //error
                        ?>
                </div>
                <div class="form-group"> 
                    <?php
                     echo $form->field($masterCategory, 'parent_id')->dropDownList(MasterCategory::getcategoryList(),['class'=>'form-control selectpicker','data-live-search'=>'true','prompt'=>'None']);
                    ?>
                    
                    
                </div>
                <div class="clearfix"></div>
                <div class="form-group m-t-10 m-b-0">
                    <button type="button" class="btn btn-primary" onclick="saveCategory()">Submit</button>&nbsp;&nbsp;
                    <button type="submit" class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>
                </div> 
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

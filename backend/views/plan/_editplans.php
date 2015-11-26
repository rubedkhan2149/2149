<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Plan;
use yii\helpers\Url;
?>
<script src="<?php echo YII::getAlias("@js_url"); ?>/bootstrap-select.js"></script>
<script>
    $('.selectpicker').selectpicker();
     
    function savePlan()
    {
        planPrice = $("#plan-amount").val();
        flag = 0;
        if(planPrice=='')
        {
            $("#amount").html("Plan price cannot be blank.");
            flag++;
        }
        if(flag==0)
        {
            $.ajax({
               url      : "<?php echo Url::toRoute("/plan/update-plan"); ?>",
               type     : 'post',
               data     : $("#plan-form").serialize(),
               dataType: "json",
               success  : function(data){
                   if(data.response=='error')
                   {
                       $("#amount").html(data.message);
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
            <h4 class="modal-title" id="myModalLabel">Edit Plan</h4>
        </div>      
        <div class="modal-body">
              <?php $form = ActiveForm::begin([
                            'id' => 'plan-form', 
                            'enableAjaxValidation' => false, 
                            'enableClientValidation' => true
                        ]); ?>
                <div class="form-group"> 
                    <label>Plan Price <span style="color:red"> *</span></label>
                        <?php 
                          echo Html::activeTextInput($plan, 'amount',['class' => 'form-control input-lg','placeholder'=>'']); //field
                          echo Html::error($plan,'amount', ['id' => 'amount','class' => 'errorMessage help-block']); //error
                        ?>
                </div>
                <div class="form-group"> 
                    <label>Time Duration <span style="color:red"> *</span></label>
                    <select class="form-control selectpicker" name="Plan[duration]" id="plan-duration">
                        <?php
                        for($i=1;$i<=10;$i++)
                        {
                        ?>
                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <?php
                     //echo $form->field($plan, 'parent_id')->dropDownList(MasterCategory::getcategoryList(),['class'=>'form-control selectpicker','data-live-search'=>'true','prompt'=>'None']);
                    ?>
                </div>
                <div class="form-group"> 
                    <label>Cycle <span style="color:red"> *</span></label>
                    <select class="form-control selectpicker" name="Plan[plan_type]" id="plan-plan_type">
                        <option value="yearly">Yearly</option>
                        <option value="monthly">Monthly</option>
                    </select>
                    <?php
                     //echo $form->field($plan, 'parent_id')->dropDownList(MasterCategory::getcategoryList(),['class'=>'form-control selectpicker','data-live-search'=>'true','prompt'=>'None']);
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

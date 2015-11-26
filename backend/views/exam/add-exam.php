<?php
use yii\helpers\Url;
$this->title = 'Add Exam';
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<article class="common_dahboardform shareexam_form">
   
<?php $form = ActiveForm::begin([
                                    'id'=>'exam-form'
                                ]); ?>
  <div class="form-group"> 
  <!--<label>Exam Name</label>-->
    
  <?php   echo $form->field($model, 'exam_name')->begin(); ?>
    <?php  echo Html::activeLabel($model,'exam_name' ,[
                                      'label'=>'Exam Name'
                 ]); ?>

          <?php   echo Html::activeTextInput($model, 'exam_name',['class' => 'form-control input-lg', 'placeholder' => 'Exam Name']); //Field ?>
          <?php   echo Html::error($model,'exam_name', ['id' => 'exam_name','class' => 'help-block help-block-error']); //error
                  echo $form->field($model, 'exam_name')->end(); ?>
  </div>
  <div class="form-group"> 
    <!--<label>Exam Type</label>-->
    <?php   echo $form->field($model, 'exam_type')->begin(); ?>
    <?php  echo Html::activeLabel($model,'exam_type' ,[
                                      'label'=>'Exam Type'
                 ]); ?>
  <div class="input-group input-group-lg">
      <?php   echo Html::activeTextInput($model, 'exam_type',['class' => 'form-control', 'placeholder' => 'Exam Type']); //Field ?>
          <?php   echo Html::error($model,'exam_type', ['id' => 'exam_type','class' => 'help-block help-block-error']); //error
                   ?>
      <span class="input-group-addon">
          <a class="link-orange add_exam_type" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
      </span>
    </div>
    <?php echo $form->field($model, 'exam_type')->end(); ?>
    </div>
    <div id="examtypearr"></div>
    <div class="form-group"> 
<!--    <label>Exam Section</label>-->
<?php   echo $form->field($model, 'exam_section')->begin(); ?>
    <?php  echo Html::activeLabel($model,'exam_section' ,[
                                      'label'=>'Exam Section'
                 ]); ?>
  <div class="input-group input-group-lg">
      <?php   echo Html::activeTextInput($model, 'exam_section',['class' => 'form-control', 'placeholder' => 'Exam Section']); //Field ?>
          <?php   echo Html::error($model,'exam_section', ['id' => 'exam_section','class' => 'help-block help-block-error']); //error
                   ?>
      <span class="input-group-addon">
        <a class="link-orange add_exam_section" href="javascript:void(0)"><i class="fa fa-plus"></i></a>
      </span>
    </div>
<?php echo $form->field($model, 'exam_section')->end(); ?>
    </div>
    <div id="examsecarr"></div>
  <div class="form-group"> 
<!--  <label>Category</label>
  <select class="form-control selectpicker input-lg" data-style="btn-ttc" >
  <option>Select Category</option>
  <option>None</option>
  <option>Health Care</option>
  <option>Health > Nursing</option>    
  </select>-->
<?php
    $categories = common\models\MasterCategory::getcategoryList();
    echo $form->field($model, 'category_id', ['inputOptions' => ['class' => 'form-control selectpicker']])
            ->dropDownList($categories, ['prompt' => 'Select Category'])->label('Category');
    ?>
  </div>
    
    <div class="form-group"> 
  <?php   echo $form->field($model, 'meta_title')->begin(); ?>
    <?php  echo Html::activeLabel($model,'meta_title' ,[
                                      'label'=>'Meta Title'
                 ]); ?>

          <?php   echo Html::activeTextInput($model, 'meta_title',['class' => 'form-control input-lg', 'placeholder' => 'Meta Title']); //Field ?>
          <?php   echo Html::error($model,'meta_title', ['id' => 'meta_title','class' => 'help-block help-block-error']); //error
                  echo $form->field($model, 'meta_title')->end(); ?>
  </div>
    
    <div class="form-group"> 
  <?php   echo $form->field($model, 'meta_keyword')->begin(); ?>
    <?php  echo Html::activeLabel($model,'meta_keyword' ,[
                                      'label'=>'Meta Keyword'
                 ]); ?>

          <?php   echo Html::activeTextInput($model, 'meta_keyword',['class' => 'form-control input-lg', 'placeholder' => 'Meta Keyword']); //Field ?>
          <?php   echo Html::error($model,'meta_keyword', ['id' => 'meta_keyword','class' => 'help-block help-block-error']); //error
                  echo $form->field($model, 'meta_keyword')->end(); ?>
  </div>
    
    <div class="form-group"> 
  <?php   echo $form->field($model, 'meta_desc')->begin(); ?>
    <?php  echo Html::activeLabel($model,'meta_desc' ,[
                                      'label'=>'Meta Description'
                 ]); ?>

          <?php   echo Html::activeTextInput($model, 'meta_desc',['class' => 'form-control input-lg', 'placeholder' => 'Meta Description']); //Field ?>
          <?php   echo Html::error($model,'meta_desc', ['id' => 'meta_desc','class' => 'help-block help-block-error']); //error
                  echo $form->field($model, 'meta_desc')->end(); ?>
  </div>
 
  <div class="clearfix"></div>
  <div class="form-group m-t-10 m-b-0">
      <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
     <!--<button type="submit" class="btn btn-primary">Add</button>-->
     &nbsp;&nbsp;
     <!--<button type="submit" class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>-->

  </div> 
<?php ActiveForm::end(); ?> 
</article>
<!--  <script type="text/javascript">
      function add_exam_type(){
//          examtypearr
var length =$( "input[value='ExamForm[exam_type][]']" ).val();
alert(length);
          var examTypeVal=$("#examform-exam_type").val();
          
          var content="<span>"+examTypeVal+"</span><input type='hidden' name='ExamForm[exam_type][]' value='"+examTypeVal+"'>";
          $("#examtypearr").append(content);
      }
  </script>-->
  <script type="text/javascript">
    $(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var wrapper         = $("#examtypearr"); //Fields wrapper
    var sectionWrapper         = $("#examsecarr"); //Fields wrapper
    var add_exam_type      = $(".add_exam_type"); //Add button ID
    var add_exam_section      = $(".add_exam_section"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_exam_type).click(function(e){ //on add input button click
        e.preventDefault();
       var examTypeVal=$("#examform-exam_type").val().trim();
        if(x <= max_fields && examTypeVal){ //max input box allowed
            x++; //text box increment
            var content="<span>"+examTypeVal+"<a href='#' class='remove_field'> x</a><input type='hidden' name='ExamForm[exam_type][]' value='"+examTypeVal+"'></span>";
            $(wrapper).append(content); //add input box
            $("#examform-exam_type").val('');
        }
    });
    
    $(add_exam_section).click(function(e){ //on add input button click
        e.preventDefault();
       var examSecVal=$("#examform-exam_section").val().trim();
        if(x <= max_fields && examSecVal){ //max input box allowed
            x++; //text box increment
            var content="<span>"+examSecVal+"<a href='#' class='remove_field'> x</a><input type='hidden' name='ExamForm[exam_section][]' value='"+examSecVal+"'></span>";
            $(sectionWrapper).append(content); //add input box
            $("#examform-exam_section").val('');
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('span').remove(); x--;
    });
    $(sectionWrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('span').remove(); x--;
    });
});
  </script>
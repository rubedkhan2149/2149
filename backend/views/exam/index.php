<?php
use yii\helpers\Url;
$this->title = 'Manage Exam';
?>
<script type="text/javascript">
$().ready(function(){
   get_exam_list();  
});
function get_exam_list(url)
{
    var post = $("#frmExamSearch").serialize();
    var url = url || "<?php echo \yii::$app->urlManager->createUrl(['exam/list'])?>";
    $.ajax({type:"POST",url:url,data:post,success:function(data){
        $(".overlay").hide();    
        $("#examGridConatiner").html(data);
    }});
}
</script>

<div class="content admin-page">
    <div class="row">
        <div class="col-md-12">
            <div class="searchuser">
                <div class="custom-search-input">
                    <form id="frmExamSearch">
                        <div class="input-group">
                            <input type="text" name="txtSearch" class="search-query form-control" placeholder="Search">
                            <button class="btn btn-danger" type="button" onclick="get_exam_list();"> <span class=" glyphicon glyphicon-search"></span> </button>                
                        </div>
                    </form>

                    <a class="pull-left btn btn-warning" href="<?php echo Url::toRoute('exam/add-exam'); ?>">Add Exam</a>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <!-- loader div-->
                        <div class="overlay text-center">
                             <i class="fa fa-spinner fa-spin fa-2x"></i>                   
                        </div>
                    <!-- loader div-->
                    <div class="panel-body">
                        <div class="row">
                            <div id="examGridConatiner">
                                <!--   ajax content goes here-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div id="exam-content"></div>
</div>
<script>
    function categoryForm(id)
    {
        $.ajax({
                type: 'GET',
                url: '<?php echo Url::toRoute("/exam/add-exam"); ?>',
                data : {exam_id:id},
                success: function (response) {
                    $('#exam-content').html('');
                    $('#exam-content').html(response);
                }
            });
    }
    function delete_category(id)
    {
        $.ajax({
                    type: 'POST',
                    url: '<?php echo Url::toRoute("/exam/delete-exam"); ?>',
                    data : {exam_id:id},
                    success: function (response) {

                    }
               });
    }
</script>    

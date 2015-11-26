<?php
use yii\helpers\Url;
$this->title = 'Manage Plans';
?>
<script type="text/javascript">
$().ready(function(){
   get_plan_list();  
});
function get_plan_list(url)
{
    var post = $("#frmPlanSearch").serialize();
    var url = url || "<?php echo \yii::$app->urlManager->createUrl(['plan/list'])?>";
    $.ajax({type:"POST",url:url,data:post,success:function(data){
        $(".overlay").hide();    
        $("#planGridContainer").html(data);
    }});
}
</script>

<div class="content admin-page">
    <div class="row">
        <div class="col-md-12">
            <div class="searchuser">
                <div class="custom-search-input">
                    <form id="frmPlanSearch">
                        <div class="input-group">
                            <input type="text" name="txtSearch" class="search-query form-control" placeholder="Search">
                            <button class="btn btn-danger" type="button" onclick="get_plan_list();"> <span class=" glyphicon glyphicon-search"></span> </button>                
                        </div>
                    </form>
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
                            <div id="planGridContainer">
                                <!--   ajax content goes here-->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div id="plan-content"></div>
</div>
<script>
    function planForm(id)
    {
        $.ajax({
                type: 'GET',
                url: '<?php echo Url::toRoute("/plan/update-plan"); ?>',
                data : {plan_id:id},
                success: function (response) {
                    $('#plan-content').html('');
                    $('#plan-content').html(response);
                }
            });
    }
    function delete_category(id)
    {
        $.ajax({
               type: 'POST',
               url: '<?php echo Url::toRoute("/category/delete-category"); ?>',
               data : {category_id:id},
               success: function (response) {
                   
               }
           });
    }
</script>    

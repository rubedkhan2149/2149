<?php
use yii\helpers\Url;
$this->title = 'Manage Categories';
?>
<script type="text/javascript">
$().ready(function(){
   get_category_list();  
});
function get_category_list(url)
{
    var post = $("#frmCatSearch").serialize();
    var url = url || "<?php echo \yii::$app->urlManager->createUrl(['category/list'])?>";
    $.ajax({type:"POST",url:url,data:post,success:function(data){
        $(".overlay").hide();    
        $("#catGridConatiner").html(data);
    }});
}
</script>

<div class="content admin-page">
    <div class="row">
        <div class="col-md-12">
            <div class="searchuser">
                <div class="custom-search-input">
                    <form id="frmCatSearch">
                        <div class="input-group">
                            <input type="text" name="txtSearch" class="search-query form-control" placeholder="Search">
                            <button class="btn btn-danger" type="button" onclick="get_category_list();"> <span class=" glyphicon glyphicon-search"></span> </button>                
                        </div>
                    </form>

                    <a class="pull-left btn btn-warning" href="#add-category" onclick="categoryForm()" data-toggle="modal" data-target="#add-category">Add Categories</a>
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
                            <div id="catGridConatiner">
                                <!--   ajax content goes here-->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div id="category-content"></div>
</div>
<script>
    function categoryForm(id)
    {
        $.ajax({
                type: 'GET',
                url: '<?php echo Url::toRoute("/category/add-category"); ?>',
                data : {category_id:id},
                success: function (response) {
                    $('#category-content').html('');
                    $('#category-content').html(response);
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

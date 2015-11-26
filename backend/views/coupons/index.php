<?php
    use yii\helpers\Url;
    $this->title = 'Manage Coupons';
?>

<script type="text/javascript">
$().ready(function(){
   get_coupon_list();  
});
function get_coupon_list(url)
{
    var post = $("#frmCouponSearch").serialize();
    var url = url || "<?php echo \yii::$app->urlManager->createUrl(['coupons/list'])?>";
    $.ajax({type:"POST",url:url,data:post,success:function(data){
        $(".overlay").hide();    
        $("#couponGridConatiner").html(data);
    }});
}
</script>
<div class="content admin-page">
    <div class="row">
        <div class="col-md-12">
            <div class="searchuser">
                <div class="custom-search-input">
                    <form id="frmCouponSearch">
                        <div class="input-group">
                            <input type="text" name="txtSearch" class="search-query form-control" placeholder="Search">
                            <button class="btn btn-danger" type="button" onclick="get_coupon_list();"> <span class=" glyphicon glyphicon-search"></span> </button>                
                        </div>
                    </form>
                    <a class="pull-left btn btn-warning" href="<?php echo Url::toRoute("coupons/add-coupon"); ?>">Add Coupon</a>
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
                            <div id="couponGridConatiner">
                                <!--   ajax content goes here-->
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
<div class="modal fade" id="add-coupon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div id="coupon-content"></div>
</div>
<script>
    function couponForm(id)
    {
        $.ajax({
                type: 'GET',
                url: '<?php echo Url::toRoute("/coupons/add-coupon"); ?>',
                data : {coupon_id:id},
                success: function (response) {
                    $('#coupon-content').html('');
                    $('#coupon-content').html(response);
                }
            });
    }
    function delete_coupon(id)
    {
        $.ajax({
               type: 'POST',
               url: '<?php echo Url::toRoute("/coupons/delete-coupon"); ?>',
               data : {coupon_id:id},
               success: function (response) {
                   
               }
           });
    }
</script>    

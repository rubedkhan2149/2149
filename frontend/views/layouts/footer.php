<footer>
    <div class="container">
         <div class="row f-top">
        <div class="col-sm-3 col-md-4 logo"> <img src="<?php echo Yii::getAlias("@images_url"); ?>/footer-logo.png" class="img-responsive"> </div>
        <div class="col-sm-6 col-md-6 middle f-brdr">
             <h2>Score Higher, Spend Less</h2>
             <h3>Largest Exam Prep Community</h3>
           </div>
        <div class="col-sm-3 col-md-2 social f-brdr">
             <h5>FOLLOW US ON</h5>
             <ul class="list-inline">
            <li><a  href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
            <li><a  href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
            <li><a  href="javascript:void(0)"><i class="fa fa-linkedin"></i></a></li>
          </ul>
           </div>
      </div>
         <ul class="list-inline text-center footer-link">
        <li><a href="<?php echo Yii::$app->urlManager->createUrl('/auth/signup');  ?>">JOIN EXAMPEEP</a></li>
        <li><a href="javascript:void(0)">ABOUT US</a></li>
        <li><a href="javascript:void(0)">PRIVACY POLICY</a></li>
        <li><a href="javascript:void(0)"> TERMS AND CONDITIONS</a></li>
        <li><a href="javascript:void(0)">FAQ</a></li>
        <li><a href="javascript:void(0)">CONTACT US</a></li>
        <li><a href="javascript:void(0)">Academic Integrity</a></li>
      </ul>
       </div>
    <p class="copyright-footer">All trademarks are properties of their respective owners. Â© 2015 - exampeep.com All rights reserved.</p>
  </footer>
  
<!--<script src="js/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/wow.min.js"></script> 
<script src="js/enscroll-0.6.1.min.js"></script> 
<script src="js/bootstrap-select.js"></script> 
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="js/jquery.smartmenus.min.js"></script> 
<script src="js/jquery.smartmenus.bootstrap.min.js"></script> -->
<script>
		(function($){
			$(window).load(function(){
			$(".message-listing").mCustomScrollbar({
				theme:"dark-2",				
				
				});
			$(".adduserlisting").mCustomScrollbar({
				theme:"dark-2",
				});	
				$(".userlisting").mCustomScrollbar({
				theme:"dark-2",
				});	
			});
		})(jQuery);
	</script>



<script>
$('.examcommunity_listingdiv').enscroll({
    horizontalScrolling: true,
    verticalTrackClass: 'vertical-track2',
    verticalHandleClass: 'vertical-handle2',
    horizontalTrackClass: 'horizontal-track2',
    horizontalHandleClass: 'horizontal-handle2',
    cornerClass: 'corner2'
});
</script>

<script type="text/javascript">
var wow = new WOW({
	offset:100,
	mobile:false
  });
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
$(function() {
    function reposition() {
        var modal = $(this),
            dialog = modal.find('.modal-dialog');
            modal.css('display', 'block');
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 2));
		}
    $('.modal').on('show.bs.modal', reposition);
    $(window).on('resize', function() {
        $('.modal:visible').each(reposition);
    });
});
</script>


<script>
$(window).resize(function (e) {
    var $nav_container = $(".registered_row .container"),
        width = ($('body').innerWidth() - $nav_container.outerWidth()) / 2
    $(".left-header, .right-header").width(width);
  }).resize();
$(document).ready(function() {   
            var sideslider = $('[data-toggle=collapse-side]');
            var sel = sideslider.attr('data-target');
            var sel2 = sideslider.attr('data-target-2');
            sideslider.click(function(event){
                $(sel).toggleClass('in');
                $(sel2).toggleClass('out');
            });
        });
         $(window).load(function(){
	
        if($( window ).width() > 767)                
      $(".navbar-static-top").sticky({ topSpacing:0 });
      
    });
</script>
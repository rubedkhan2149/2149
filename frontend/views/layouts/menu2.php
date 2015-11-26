<?php 
use yii\helpers\Url;
?>
   <div class="top_header">
    <div class="container">
         <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3 logo"> <a href="<?php echo Yii::$app->urlManager->createUrl('/home');  ?>" class="navbar-brand"> <img src="<?php echo Yii::getAlias("@images_url"); ?>/logo.jpg" alt="exampeep" class="img-responsive" /> </a> </div>
        <div class="col-lg-6 col-md-6 col-sm-5 searchdiv">
             <div class="custom-search-input">
            <div class="input-group">
                 <input type="text" placeholder="Which exam are you taking?" class="search-query form-control">
                 <button type="button" class="btn btn-danger"> <span class=" glyphicon glyphicon-search"></span> </button>
               </div>
          </div>
           </div>
        <div class="col-lg-3 col-md-3 col-sm-4 accountlist text-right hidden-xs">
             <ul class="list-inline">
                 <?php if (!Yii::$app->user->isGuest) { ?>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/auth/login/logout');  ?>"><img src="<?php echo Yii::getAlias("@images_url"); ?>/signup-icon.png"  alt="signup"/> LOG OUT</a></li>
                 <?php }else{ ?>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/auth/signup');  ?>"><img src="<?php echo Yii::getAlias("@images_url"); ?>/signup-icon.png"  alt="signup"/> SIGN UP</a></li>
            <li><a href="<?php echo Yii::$app->urlManager->createUrl('/auth/login');  ?>" ><img src="<?php echo Yii::getAlias("@images_url"); ?>/signin-icon.png"  alt="signup"/> LOG IN</a></li>
                 <?php } ?>
             </ul>
           </div>
      </div>
       </div>
  </div>
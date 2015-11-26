<?php
use yii\helpers\Url;
?>
<header class="topheader clearfix">
   <div class="left">
   <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle hidden-sm">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
   </button>
   <h3 class="hidden-xs">Dashboard</h3>
   </div>
    <ul class="list-inline right">
        <li><a href="<?php echo Url::toRoute("/home/index");  ?>"> <i class="fa fa-home homeicon"></i> </a> </li>
        <li class="usernamepic">
            <?php
            
            ?>
            <!-- <div class="userimg" style="background-image:url(<?php echo YII::getAlias("@images_url"); ?>/userpic.jpg)"></div>-->
            <div class="default_userimg"><?php echo substr(ucfirst(\Yii::$app->user->identity->username),0,1); ?></div>
            <?php
            
            ?>
            <span class="name"><?php echo ucfirst(\Yii::$app->user->identity->username); ?></span>
        </li>
        <li class="logout">
            <a href="<?php echo Url::toRoute("/auth/login/logout"); ?>">
                <span aria-hidden="true" class="glyphicon glyphicon-off"></span>
            </a>
        </li>
    </ul>
</header>        
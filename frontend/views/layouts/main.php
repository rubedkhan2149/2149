<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use frontend\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
   
    <!--[if lt IE 9]>  
     <script src="<?php echo Yii::getAlias("@js_url"); ?>/html5shiv.js"></script>
    <script src="<?php echo Yii::getAlias("@js_url"); ?>/respond.min.js"></script> 
 <![endif]-->
    
     <script>
		if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
		   var msViewportStyle = document.createElement('style')
		   msViewportStyle.appendChild(
		   document.createTextNode(
		   '@-ms-viewport{width:auto!important}'
			)
		  )
		  document.querySelector('head').appendChild(msViewportStyle)
		}
   </script>
</head>
<body>
    <?php $this->beginBody() ?>
    
    <header role="banner" class="navbar navbar-static-top navbar-inverse">
     <div class="container">
    <div class="navbar-header">
         <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle pull-left"><span class="icon-bar"></span><span class="icon-bar"></span> <span class="icon-bar"></span></button>
         <ul class="list-inline visible-xs accountlist-nav">
        <li><a href="javascript:void(0)"><img class="hidden-xs" src="<?php echo Yii::getAlias("@images_url"); ?>/signup-icon.png"  alt="signup"/> SIGN UP</a></li>
        <li><a href="javascript:void(0)"><img class="hidden-xs" src="<?php echo Yii::getAlias("@images_url"); ?>/signin-icon.png"  alt="signup"/> LOG IN</a></li>
      </ul>
       </div>
    <div class="navbar-inverse side-collapse in">
         <?php echo $this->render('//layouts/menu');?>
       
        
        
       </div>
  </div>
   </header>
  
    <div class="side-collapse-container">
          <?php echo $this->render('//layouts/menu2');?>
        
          <?= $content ?>
        
         <?php echo $this->render('//layouts/footer');?>
    </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

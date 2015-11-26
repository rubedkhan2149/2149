<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
        
    <div class="userdashboard-page">
   <div class="dashboard_side admin-side">
 
     <main class="side-collapse-container">
       <div class="main-container">
         <header class="topheader clearfix">
           <div class="left">
           <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle hidden-sm"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
           <h3 class="hidden-xs"><?php echo $this->title?></h3>
           </div>
        
         </header>        
         <div class="mobile_dashboard_heading visible-xs"><h3><?php echo $this->title?></h3></div>
           <div class="content">
               
                <?= $content ?>
               
               
            
           </div>
        
       </div>
     </main>
     </div>
   </div>
        

       
       
     

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

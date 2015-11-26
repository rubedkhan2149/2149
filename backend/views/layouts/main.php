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
        
    <div class="userdashboard-page">
   <div class="dashboard_side admin-side">
     <header role="banner" class="navbar dashboard_menu">
       <div class="navbar-header"> <a href="index.php">
               <img alt="logo" src="<?php echo yii::$app->urlManagerFrontEnd->baseUrl?>/images/footer-logo.png" class="img-responsive" /> </a> 
       </div>
       <div class="clearfix"></div>
       <div class="side-collapse in">
         
           <nav role="navigation" class="navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href=""><i class="fa fa-dashboard"></i> Dashboard</a></li>
              <li><a href="javascript:void(0)"><i class="fa fa-users"></i>Manage Users</a></li>
              <li><a href="javascript:void(0)" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2"><i class="fa fa-list"></i>Manage Categories & Exams<span class="caret"></span></a>
               <ul class="collapse list-unstyled subcategory_list" id="collapse2">
                     <li><a href="<?php echo yii::$app->urlManager->createUrl(['/category'])?>"><i class="fa fa-university"></i>Manage Category</a></li>
                     <li><a href="<?php echo yii::$app->urlManager->createUrl(['/exam'])?>"><i class="fa fa-clone"></i>Manage Exam</a></li>

               </ul>
              </li>
              <li><a  href="javascript:void(0);" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapse1"><i class="fa fa-cubes"></i>manage Product & Services<span class="caret"></span></a>
               <ul class="collapse list-unstyled subcategory_list" id="collapse1">
                     <li><a href="manage-company.php"><i class="fa fa-university"></i>Add Company</a></li>
                     <li><a href="addnew-product.php"><i class="fa fa-cart-plus"></i>Add New Product</a></li>
                     <li><a href="addproductcategory.php"><i class="fa fa-clone"></i>Add New Category</a></li>
                     <li><a href="preview.php"><i class="fa fa-eye"></i>Preview</a></li>
               </ul>
              </li>
              <li><a href="manage-examexperiences.php"><i class="fa fa-paper-plane-o"></i>Manage exam experiences</a></li>
              <li><a href="managepracticequestion.php"><i class="fa fa-question-circle"></i>Manage Practice Question</a></li>
              <li><a href="manageexam_prepopinion.php"><i class="fa fa-sliders"></i>Manage Exam Prep Opinion</a></li>
              <li><a href="manage_examwiki.php"><i class="fa fa-globe"></i>Manage Exam Wiki</a></li>
              <li><a href="manage-forum.php"><i class="fa fa-forumbee"></i>Manage Forum</a></li>
              <li><a href="manage-membership.php"><i class="fa fa-money"></i>Manage Membership</a></li>
              <li><a href="manage-coupons.php"><i class="fa fa-pencil-square-o"></i>Manage Coupons</a></li>
              <li><a href="admin_changepassword.php"><i class="fa fa-key"></i> Change Password</a></li>
            </ul>
         </nav>
           
           
           
           
           
       </div>
     </header>
     <main class="side-collapse-container">
       <div class="main-container">
         <header class="topheader clearfix">
           <div class="left">
           <button data-toggle="collapse-side" data-target=".side-collapse" data-target-2=".side-collapse-container" type="button" class="navbar-toggle hidden-sm"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
           <h3 class="hidden-xs"><?php echo $this->title?></h3>
           </div>
           <ul class="list-inline right">
   
             <li class="usernamepic">
                <?php
                $pic= \common\models\User::getProfileUrl(yii::$app->user->id);
                if($pic)
                { 
                ?>    
               <div class="userimg" style="background-image:url(<?php echo $pic?>)"></div>
               <?php
                }
                else
                {
                ?>
                    <div class="default_userimg"><?php echo substr(ucfirst(\Yii::$app->user->identity->username),0,1); ?></div>
                <?php    
                }
               ?>
               <span class="name"><?php echo ucfirst(\Yii::$app->user->identity->username); ?></span></li>
             <li class="logout"><a href="<?php echo yii::$app->urlManager->createUrl(['auth/login/logout']);?>"><span aria-hidden="true" class="glyphicon glyphicon-off"></span></a></li>
           </ul>
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

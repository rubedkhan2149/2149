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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    
   <div class="userdashboard-page">
   <div class="dashboard_side">
     <header role="banner" class="navbar dashboard_menu">
       <div class="navbar-header"> 
            <a href="index.php"> <img alt="logo" src="<?php echo YII::getAlias('@images_url'); ?>/footer-logo.png" class="img-responsive" /> </a> 
       </div>
       <div class="clearfix"></div>
       <div class="side-collapse in">
         <nav role="navigation" class="navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="javascript:void(0);"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-align-justify"></i> My Experiences</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-sliders"></i> My Opinions</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-question-circle"></i> My Questions</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-forumbee"></i> My Forum</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-globe"></i> My Wiki</a></li>
                <li><a href="javascript:void(0);"><i class="fa fa-user"></i> My Profile</a></li> 
                <li><a href="javascript:void(0);"><i class="fa fa-key"></i> Change Password</a></li>            
            </ul>
         </nav>
       </div>
     </header>
     <main class="side-collapse-container">
       <div class="main-container">
        <?php echo $this->render('header');?>
         <div class="mobile_dashboard_heading visible-xs"><h3>Dashboard</h3></div>
           <div class="content">
             <div class="dashboardboxes">
               <div class="row">
                 <div class="col-md-4 col-sm-4">
                   <div class="panel no-bd panel-stat">
                        <div class="panel-body bg-orange">
                            <div class="icon"><i class="fa fa-book"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="stat-num">300</div>
                                    <h3>Shared Exam Experiences</h3>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-4 col-sm-4">
                   <div class="panel no-bd panel-stat">
                        <div class="panel-body bg-green">
                            <div class="icon"><i class="fa fa-file-text"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="stat-num">150</div>
                                    <h3>Shared Exam Prep Opinions</h3>                                  
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-4 col-sm-4">
                   <div class="panel no-bd panel-stat">
                        <div class="panel-body bg-blue">
                            <div class="icon"><i class="fa fa-question-circle"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="stat-num">230</div>
                                    <h3>Shared Practice Questions</h3>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-4 col-sm-4">
                   <div class="panel no-bd panel-stat">
                        <div class="panel-body bg-green">
                            <div class="icon"><i class="fa fa-forumbee"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="stat-num">200</div>
                                    <h3>Posted Forums</h3>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-4 col-sm-4">
                   <div class="panel no-bd panel-stat">
                        <div class="panel-body bg-blue">
                            <div class="icon"><i class="fa fa-globe"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="stat-num">170</div>
                                    <h3>Posted Wikies</h3>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 <div class="col-md-4 col-sm-4">
                   <div class="panel no-bd panel-stat">
                        <div class="panel-body bg-orange">
                            <div class="icon"><i class="fa fa-wechat"></i>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="stat-num">450</div>
                                    <h3>Chatrooms Joined</h3>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
                 
               </div>
             </div>
           </div>
       </div>
     </main>
   </div>
   </div>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
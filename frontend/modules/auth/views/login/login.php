<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = "Login";
?>
<main class="main_content innerpages_content">
    <div class="new-background-image-brochure"></div>
    <div class="signup_mainbox">    
        <div class="container"> 
            <header>   
                <h2>Welcome to ExamPeep</h2>
                <p>Please enter your email and password to sign in.<br>If you haven't created an account, sign up and get started now.</p>
            </header>
            <div class="row">
                <div class="col-lg-10 col-lg-offset-1">
                    <div class="signup_innerbox login_innerbox">
                        <div class="row">
                            <div class="col-sm-6 left">
                                <h1>Login</h1> 
                                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <?= Yii::$app->session->getFlash('success') ?>
                                    </div>
                                    <?php endif; ?>

                                    <div class="loginbox">
                                    <?php 
                                        $form = ActiveForm::begin([
                                                                    'enableAjaxValidation' => true, 
                                                                    'enableClientValidation' => false
                                                                ]); 
                                    ?> 

                                    <?php echo $form->field($model, 'username')->begin();
                                    //echo Html::activeLabel($model,'username'); //label 
                                    ?>
                                    <label>Username or Email:<span class="color-red">*</span></label>
                                    <?php echo Html::activeTextInput($model, 'username', ['class' => 'form-control input-lg', 'placeholder' => 'Username or Email']); //Field ?>
                                    <?php
                                    echo Html::error($model, 'username', ['class' => 'help-block']); //error
                                    echo $form->field($model, 'username')->end();
                                    ?>	
                                    <?php echo $form->field($model, 'ud_password')->begin();
                                    //echo Html::activeLabel($model,'password'); //label 
                                    ?>
                                    <label>Password:<span class="color-red">*</span></label>
                                    <?php echo Html::activePasswordInput($model, 'ud_password', ['class' => 'form-control input-lg', 'placeholder' => 'Password']); //Field  ?>
                                    <?php
                                    echo Html::error($model, 'ud_password', ['class' => 'help-block']); //error
                                    echo $form->field($model, 'ud_password')->end();
                                    ?>	
                                    <div class="checkbox">
                                        <label>
                                            <?php echo Html::activeCheckbox($model, 'rememberMe'); //Field ?> 
                                        </label>
                                        <a href="<?php echo Yii::$app->urlManager->createUrl("auth/login/request-password-reset"); ?>" class="link-blue pull-right">Forget Password?</a>
                                    </div>
<?= Html::submitButton('Login', ['class' => 'btn btn-warning pull-left', 'id' => 'login-button']) ?>

                                    <div class="forgot_pass"> <span class="pull-right">   <a href="<?php echo Yii::$app->urlManager->createUrl('/auth/signup'); ?>" class="link-blue">Not a member? Signup</a> </span> </div>
<?php ActiveForm::end(); ?>
                                </div>


                            </div>

                            <div class="col-sm-6 right">
                                <hgroup>
                                    <h1>Score Higher, Spend Less</h1>
                                    <h3>The Largest Exam Prep Community on the Web</h3>
                                </hgroup>

                                <h2>Free Membership</h2>
                                <ul class="createacc-list list-unstyled">
                                    <li> Access additional exam experiences, practice questions and wiki study guides.</li>
                                    <li> Participate in live chat study groups.</li>
                                    <li> Post topics and comments in forums.</li>
                                </ul>

                                <h2>Community Member (Only $19/ year)</h2>
                                <ul class="createacc-list list-unstyled">
                                    <li> Access unlimited exam experiences, practice questions and wiki study guides.</li>
                                    <li> Track practice questions completed and missed.</li>
                                    <li> Keep your information private â€“ Only minimal registration information required.</li>
                                </ul>               


                            </div>

                        </div>    
                    </div>    
                </div>   
            </div>      
        </div>
    </div>

</main>
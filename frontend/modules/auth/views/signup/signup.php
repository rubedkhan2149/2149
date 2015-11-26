<?php
$this->title = "Sign Up";
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
?>
<script type="text/javascript">
    function apply_coupan() {
        var code = $('#code').val();
        var data = {code: code};
        $.ajax({
            url: "<?php echo Yii::$app->urlManager->createUrl('auth/signup/apply-code') ?>",
            type: "post",
            data: data,
            success: function (response)
            {
                var amountBeforeDiscount = $("#amount_before_discount").val();
                var res = JSON.parse(response);
                if (res.success)
                {
                    var amountAfterDiscount = amountBeforeDiscount - res.data.discount;
                    $("#promo_block").removeClass("has-error");
                    $('#error_promo').html('');
                    $('#summary > tbody > tr').eq(0).after('<tr id="discount"><td>Discount</td><td>$' + res.data.discount + '</td></tr>');
                    $('#total').html(amountAfterDiscount);
                    $('#amount_after_discount').val(amountAfterDiscount);
                    $('#discount_amount').val(res.data.discount);
                    var customVal = $('#custom').val();
                    customVal = customVal + " || " + res.data.id;
                    $('#custom').val(customVal);
//                    $('#amount').val(amountAfterDiscount);
                }
                else
                {
                    $('#discount').remove();
                    $("#promo_block").addClass("has-error");
                    $('#error_promo').html(res.error);
                    $('#total').html(amountBeforeDiscount);
                    $('#amount_after_discount').val(amountBeforeDiscount);
                    $('#discount_amount').val('');
                    var customVal = $('#custom').val();
                    customVal = customVal.split("||");
                    var newVal = '';
                    for (i = 0; i < customVal.length - 1; i++) {
                        newVal += customVal[i] + " ||";
                    }
                    var str = newVal.substring('||', newVal.length - 2);
                    str = str.trim();
                    $('#custom').val(str);
//                    $('#amount').val(amountBeforeDiscount);
                }
            }
        });
    }
</script>
<!--<div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog loginmodal" role="document">
        <div class="modal-content">      
            <div class="modal-body">
                <div class="loginbox">
                    <header class="text-center">
                        <div class="modallogo">
                            <img src="<?php echo Yii::getAlias("@images_url"); ?>/logo.jpg" class="img-responsive center-block" />
                        </div>
                        <h2 class="text-center">LOG IN</h2>
                    </header>
                    <form>
                        <div class="form-group"> 
                            <input type="email" class="form-control input-lg" placeholder="Username or Email">
                        </div>
                        <div class="form-group">   
                            <input type="password" class="form-control input-lg" placeholder="Password">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> Remember me
                            </label>
                            <a href="javascript:void(0)" class="link-blue pull-right">Forget Password?</a>
                        </div>  
                        <div class="form-group">   
                            <button type="submit" class="btn btn-primary">Login</button>&nbsp;&nbsp;
                            <button type="submit" class="btn btn-default" data-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                        <div class="form-group"> 
                            <a href="<?php echo Yii::$app->urlManager->createUrl('/auth/signup'); ?>" class="link-blue">Not a member? Signup</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->


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
                    <div class="signup_innerbox">
                        <div class="row">
                            <div class="col-sm-6 left" style="display: <?php echo ($step == 1 ) ? 'block' : 'none'; ?>">
                                <h1>Sign Up</h1>

                                <div class="choose_registration">
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="free_member" value="option1" onclick="getSignupForm('free')" > Free Member 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="inlineRadioOptions" id="suppoting_member" value="option2" onclick="getSignupForm('paid')" checked="checked"> 
<?php echo $plan['plan_name']; ?> (Only $<?php echo $plan['amount']; ?>/<?php echo $plan['plan_type']; ?>)
                                    </label>
                                </div>
                                
                                <div class="free_member_form" style="display:none">
                                    <?php $form = ActiveForm::begin([
                                        'id'=>'free-member-form'
                                    ]); ?>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
<?= $form->field($model, 'username')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Username'])->label('Username:<span style="color:red"> *</span>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
<?= $form->field($model, 'ud_password')->passwordInput(['class' => 'form-control input-lg', 'placeholder' => 'Password'])->label('Password:<span style="color:red"> *</span>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
<?= $form->field($model, 'email')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Email'])->label('Email:<span style="color:red"> *</span>'); ?>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
<?= $form->field($model, 'first_name')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'First name'])->label('First name:<span style="color:red"> *</span>'); ?>       
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
<?= $form->field($model, 'last_name')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Last name'])->label('Last name:<span style="color:red"> *</span>'); ?>       
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
<?= $form->field($model, 'address_line1')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Address'])->label('Address:<span style="color:red"> *</span>'); ?>     
                                    </div>  

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?php
                                                $countries = common\models\MasterCountry::getCountryList();
                                                $countriesData = ArrayHelper::map($countries, 'country_id', 'country_name');
                                                echo $form->field($model, 'country_id', ['inputOptions' => ['class' => 'form-control selectpicker', 'data-style' => 'btn-ttc']])
                                                        ->dropDownList($countriesData, ['prompt' => 'Select Country', 'onchange' => '
                         $.get("' . Yii::$app->urlManager->createUrl('/auth/signup/getstates') .
                                                            '/"+$(this).val(),function( data ) 
                               {
                                          $( "select#signup-state_id" ).html( data );
                                          $( "select#signup-state_id" ).selectpicker("refresh");
                                        });
                        '])->label('Country <span class="color-red">*</span>');
                                                ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?php
                                                echo $form->field($model, 'state_id', ['inputOptions' => ['class' => 'form-control selectpicker']])->dropDownList([], ['prompt' => 'Select State', 'class' => 'form-control input-lg selectpicker ', 'data-size' => '5'])->label('State <span class="red">*</span>');
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
<?= $form->field($model, 'city')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'City'])->label('City:<span style="color:red"> *</span>'); ?>     
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
<?= $form->field($model, 'zipcode')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Zipcode'])->label('Zipcode:<span style="color:red"> *</span>'); ?>        
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
<?= $form->field($model, 'edu_level')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Education level and Current School'])->label('Education level and Current School:<span style="color:red"> *</span>'); ?>    
                                    </div> 

                                    <div class="form-group">
<?= $form->field($model, 'upcoming_exam')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Upcoming Exams and Dates'])->label('Upcoming Exams and Dates:<span style="color:red"> *</span>'); ?>     
                                    </div>     
                                    <input type="hidden" name="type" value="free">
                                    <?= Html::submitButton('Sign Up', ['class' => 'btn btn-warning pull-left']) ?>
                                    <div class="forgot_pass"> <span class="pull-right"> <a class="link-blue" href="<?php echo Yii::$app->urlManager->createUrl('/auth/login'); ?>">Already a member? Login</a> </span> </div>
<?php ActiveForm::end(); ?>
                                </div>

                                <div class="supporting_member_form" >
                                    <?php $form = ActiveForm::begin(
                                            [
                                                'id'=>'community-form'
                                            ]); ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?= $form->field($model, 'username')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Username'])->label('Username:<span style="color:red"> *</span>'); ?>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?= $form->field($model, 'ud_password')->passwordInput(['class' => 'form-control input-lg', 'placeholder' => 'Password'])->label('Password:<span style="color:red"> *</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <?= $form->field($model, 'email')->textInput(['class' => 'form-control input-lg', 'placeholder' => 'Email'])->label('Email:<span style="color:red"> *</span>'); ?>
                                    </div>
                                    <input type="hidden" name="type" value="community">
                                    <button class="btn btn-warning pull-left" name="step_<?php echo $step; ?>" type="submit"> Next</button> 
                                    <div class="forgot_pass"> <span class="pull-right"> <a class="link-blue" href="<?php echo Yii::$app->urlManager->createUrl('/auth/login'); ?>">Already a member? Login</a> </span> </div>
                                    <?php ActiveForm::end(); ?>
                                </div>
                                
                            </div>
                            <div class="col-sm-6 left" style="display: <?php echo ($step == 2 ) ? 'block' : 'none'; ?>">
                                <h1>Membership Plan</h1>
                                <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr" class="paypal ng-pristine ng-valid" id="paypal_form">
                                    <input type="hidden" value="_xclick" name="cmd">
                                    <input type="hidden" value="admin@neuronsolutions.com" name="business">
                                    <input type="hidden" value="USD" name="currency_code">
                                    <input type="hidden" value="<?php echo $plan['plan_name']; ?>" name="item_name">
                                    <input type="hidden" value="<?php echo $plan['amount']; ?>" name="amount">
                                    <input type="hidden" value="<?php echo $plan['amount']; ?>" name="amount_before_discount" id="amount_before_discount">
                                    <input type="hidden" value="" name="discount_amount" id="discount_amount">
                                    <input type="hidden" value="<?php echo $plan['amount']; ?>" name="amount_after_discount" id="amount_after_discount">
                                    <input type="hidden" value="<?php echo $model['username']; ?> || <?php echo $model['ud_password']; ?> || <?php echo $model['email']; ?> || <?php echo $plan['id']; ?> || <?php echo $plan['plan_type']; ?>" name="custom" id="custom">
                                    <input name="cancel_return" type="hidden" value="http://localhost/exampeep/auth/signup" />
                                    <input name="return" type="hidden" value="http://localhost/exampeep/auth/signup/validate_txn" />        
                                    <input type="hidden" value="2" name="rm">
                                        <!--<input name="return" type="hidden" value="http://krewcal.whatall.com/api/web/index.php/v1/production/validate_txn" />-->
                                    <input name="notify_url" type="hidden" value="http://localhost/exampeep/auth/signup/validate_txn" />

                                    <table class="table" id="summary">
                                        <thead>
                                            <tr>
                                                <th>Descriptions</th>
                                                <th>Amount </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td> <?php echo $plan['plan_name']; ?></td>
                                                <td>$<?php echo $plan['amount']; ?>/<?php echo $plan['plan_type']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td>$<span id="total">19</span></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="form-group promocode ">
                                        <label>Do you have any promo code?</label>                     
                                        <div class="input-group input-group-lg" id="promo_block">
                                            <input type="text" class="form-control" id="code" placeholder="Enter Promo code">
                                            <div class="help-block" id="error_promo"></div>
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" onclick="apply_coupan()" type="button">Apply</button>
                                            </span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-warning pull-left"> Proceed To Pay</button>
                                </form>
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
<script>
    $(document).ready(function () {
        <?php
        if(Yii::$app->request->post('type')!='')
        {
            ?>
            getSignupForm('<?php echo Yii::$app->request->post('type'); ?>');
        <?php                
        }
        ?>
        
//    $("#free_member").click(function(){
//        $(".free_member_form").show();
//		$(".supporting_member_form").hide();		
//    });	
//	$("#suppoting_member").click(function(){
//        $(".free_member_form").hide();
//		$(".supporting_member_form").show();		
//    });	
    });
    function getSignupForm(value)
    {
        if (value == 'free')
        {
            $(".free_member_form").show();
            $(".supporting_member_form").hide();
        }
        else
        {
            $(".free_member_form").hide();
            $(".supporting_member_form").show();
        }
    }
</script>

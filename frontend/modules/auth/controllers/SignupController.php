<?php

namespace frontend\modules\auth\controllers;
use yii;
class SignupController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new \common\models\SignUp();
        $model->scenario='community';
        $plan = \common\models\Plan::findOne(['plan_name'=>'Community Member']);
        $step = 1;
        if(Yii::$app->request->post('type')=='free'){
            $model->scenario='free';
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) 
        {
            if(Yii::$app->request->post('type')=='free')
            {  
              $model->registerFreeMember();
              \Yii::$app->session->setFlash('success', 'Successfully Registered');
                          return $this->redirect(['/auth/login']);
            }
            else
            {
                $model->scenario   = 'community';
                if(isset($_POST['step_1']))
                {               
                    if($model->validate()) 
                    {
                        $step = 2;
                    }
                    else
                    { 
                       $step = 1;
                       return $this->render('signup', [ 
                                                      'model'=> $model,
                                                      'step' => $step,
                                                      'plan' => $plan,
                                          ]);
                    }
                }
                // \yii\helpers\VarDumper::dump($model,10,true); die;
            }
        }
            return $this->render('signup', [
                            'model' => $model,
                            'step' => $step,
                            'plan' => $plan,
                ]);
        
    }

    public function actionGetstates($id) {
        $state=\common\models\MasterState::getStateListByCountryId($id);
         if(!empty($state)){
            echo "<option value =''>Select state</option>";
            foreach($state as $post){
                echo "<option value='".$post->id."'>".$post->state_name."</option>";
            }
        }
        else{
            echo "<option value =''>Select state</option>";
        }
    }
    
    public function actionValidate_txn()
    { 
        //  $propBooking=new PropBooking;
        $ipnObject= new \frontend\components\IpnListener();
        $ipnObject->use_sandbox=true;
        //$model = \common\models\User::findOne(['id'=>5]);
        //$model->save(FALSE);
        try 
        {
            $ipnObject->requirePostMethod();
            $verified = $ipnObject->processIpn();
            //echo $verified;
        } 
        catch(\Exception $e)
        {
            error_log($e->getMessage());
            exit(0);
        }
        if ($verified)
        {
            if(!empty($_REQUEST))
            {  
                //$txnId=$_REQUEST['txn_id'];
               // $bookingCheck=  PropBooking::model()->find("pb_txnno='$txnId'");
               $model = new \common\models\User();
               $user=$model->saveUser($_REQUEST);
               $userAddressModel=new \common\models\UserAddress();
               $userAddressModel->user_id=$user->id;
               $userAddressModel->save();
               $userProfileModel=new \common\models\UserProfile();
               $userProfileModel->user_id=$user->id;
               $userProfileModel->save();

               $transactionModel=new \common\models\UserTransaction();
               $transactionDetails=$transactionModel->saveTransaction($user->id,$_REQUEST);
               
               $subscriptionModel=new \common\models\Subscription();
               $subscriptionDetails=$subscriptionModel->saveSubscription($user->id,$transactionDetails->id,$_REQUEST);

               $customData=  explode('||', $_REQUEST['custom']);
               if(isset($customData[5]) && $customData[5]!='')
               {
                    $couponModel=new \common\models\CouponHistory();
                    $couponModel->saveHistory($user->id,$_REQUEST,$transactionDetails->txn_id);
               }
            }
            return $this->redirect(['index']);
                //$resultAmnt=$this->property_model->check_price($price, $id);
        }
        else
        {
            //$this->payment_cancelled();
            //echo "payment is not verified";
        }
    }
    public function actionApplyCode() 
    {
          $model=new \common\models\Coupon();
          $code=Yii::$app->request->post('code');
          $res=$model->applyCode($code);
          return json_encode($res);
    }
}

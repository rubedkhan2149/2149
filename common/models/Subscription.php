<?php

namespace common\models;

use Yii;
use common\models\base\BaseSubscription;
use common\models\query\SubscriptionQuery;
use yii\helpers\ArrayHelper;

 class Subscription extends BaseSubscription{
    public static function find()
    {
        return new SubscriptionQuery(get_called_class());
    }
    
     public function rules() {
        return ArrayHelper::merge(
            parent::rules(),
            [
                    
                ]);
       }
       
       public function attributeLabels() {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                    
                ]);
       }
       
       public function saveSubscription($userId,$utId,$data) 
       {
           $customData=  explode('||', $data['custom']);
           $this->user_id=$userId;
            $this->plan_id=  trim($customData[3]);
            $this->ut_id=$utId;
            $this->amount=$data['mc_gross'];
           $planType=trim($customData[4]);
           if($planType=='yearly'){
               $this->start_date=  date('Y-m-d');
               $this->end_date= date('Y-m-d', strtotime('+1 years'));
           }
           if($this->save())
            {
                return $this;
            }else{
                return false;
            }
       }
}

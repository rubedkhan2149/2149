<?php

namespace common\models;

use Yii;
use common\models\base\BaseCouponHistory;
use common\models\query\CouponHistoryQuery;
use yii\helpers\ArrayHelper;

 class CouponHistory extends BaseCouponHistory{
    public static function find()
    {
        return new CouponHistoryQuery(get_called_class());
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
       
       public function saveHistory($userId,$data,$txnId) {
           $customData=  explode('||', $data['custom']);
           $this->coupon_id=trim($customData[5]);
           $this->txn_id=$txnId;
           $this->user_id=$userId;
           $this->amount=$data['mc_gross'];
           if($this->save())
            {
                return $this;
            }else{
                return false;
            }
       }
}

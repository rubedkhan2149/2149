<?php

namespace common\models;

use Yii;
use common\models\base\BaseUserTransaction;
use common\models\query\UserTransactionQuery;
use yii\helpers\ArrayHelper;

 class UserTransaction extends BaseUserTransaction{
    public static function find()
    {
        return new UserTransactionQuery(get_called_class());
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
       
       public function saveTransaction($userId,$data) 
       {
           $this->amount=$data['mc_gross'];
            $this->user_id=$userId;
            $this->txn_id=$data['txn_id'];
           
           if($this->save())
            {
                return $this;
            }else{
                return false;
            }
       }
}

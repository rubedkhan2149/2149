<?php

namespace common\models;

use Yii;
use common\models\base\BaseUserAddress;
use common\models\query\UserAddressQuery;
use yii\helpers\ArrayHelper;

 class UserAddress extends BaseUserAddress{
    public static function find()
    {
        return new UserAddressQuery(get_called_class());
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
}

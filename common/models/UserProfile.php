<?php

namespace common\models;

use Yii;
use common\models\base\BaseUserProfile;
use common\models\query\UserProfileQuery;
use yii\helpers\ArrayHelper;

 class UserProfile extends BaseUserProfile{
    public static function find()
    {
        return new UserProfileQuery(get_called_class());
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

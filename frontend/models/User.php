<?php

namespace app\models;

use Yii;
use app\models\base\BaseUser;
use app\models\query\UserQuery;
use yii\helpers\ArrayHelper;

 class User extends BaseUser{
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
    
     public function rules() {
        return ArrayHelper::merge(
            parent::rules(),
            [
                    [],
                ]);
       }
       
       public function attributeLabels() {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                    [],
                ]);
       }
}

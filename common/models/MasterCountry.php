<?php

namespace common\models;

use Yii;
use common\models\base\BaseMasterCountry;
use common\models\query\MasterCountryQuery;
use yii\helpers\ArrayHelper;

 class MasterCountry extends BaseMasterCountry{
    public static function find()
    {
        return new MasterCountryQuery(get_called_class());
    }
    
     public function rules() 
      {
        return ArrayHelper::merge(
            parent::rules(),
            [
                    
                ]);
       }
       
       public function attributeLabels() 
       {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                    
                ]);
       }
       
       public static function getCountryList() 
       {
           return self::find()->activeCountry()->all();
       }
}

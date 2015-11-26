<?php

namespace common\models;

use Yii;
use common\models\base\BaseMasterState;
use common\models\query\MasterStateQuery;
use yii\helpers\ArrayHelper;

 class MasterState extends BaseMasterState{
    public static function find()
    {
        return new MasterStateQuery(get_called_class());
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
       
       public static function getStateListByCountryId($id) {
           return self::find()->stateByCountryId($id)->all();
       }
}

<?php

namespace common\models;

use Yii;
use common\models\base\BaseExamType;
use common\models\query\ExamTypeQuery;
use yii\helpers\ArrayHelper;

 class ExamType extends BaseExamType{
    public static function find()
    {
        return new ExamTypeQuery(get_called_class());
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
       
       public function behaviors()
         {
             return [
                 'timestamp' => [
                        'class' => \yii\behaviors\TimestampBehavior::className(),
                        'createdAtAttribute' => 'created_at',
                        'updatedAtAttribute' => 'updated_at',
                        'value' => new \yii\db\Expression('NOW()'),
                     'attributes' => [
                         \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                         \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                     ],
                 ],
             ];
         }
}

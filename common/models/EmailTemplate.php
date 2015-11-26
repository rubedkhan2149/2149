<?php

namespace common\models;

use Yii;
use common\models\base\BaseEmailTemplate;
use common\models\query\EmailTemplateQuery;
use yii\helpers\ArrayHelper;

class EmailTemplate extends BaseEmailTemplate
{
    public static function find()
    {
        return new EmailTemplateQuery(get_called_class());
    }
    
    public function rules()
    {
        return ArrayHelper::merge(
            parent::rules(),
            [
                    
            ]
        );
    }
       
    public function attributeLabels() 
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                  
            ]
        );
    }
    
    public static function getEmailTemplate($title)
    {
        return self::find()->byTitle($title)->one();
    }
}

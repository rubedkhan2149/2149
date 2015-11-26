<?php

namespace common\models\query;

use Yii;


class EmailTemplateQuery extends \yii\db\ActiveQuery
{
    public function byTitle($title)
    {
        $this->andWhere(['title'=>$title]);
        return $this;
    }
   
}

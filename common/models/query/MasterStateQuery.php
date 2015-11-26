<?php

namespace common\models\query;

use Yii;


class MasterStateQuery extends \yii\db\ActiveQuery
{
   public function stateByCountryId($id) {
        $this->andWhere(['country_id'=>$id]);
        return $this;
    }
}

<?php

namespace common\models\query;

use Yii;


class MasterCountryQuery extends \yii\db\ActiveQuery
{
    public function activeCountry() {
        $this->andWhere(['status'=>'active']);
        return $this;
    }
}

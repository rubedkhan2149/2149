<?php

namespace common\models\query;

use Yii;


class PlanQuery extends \yii\db\ActiveQuery
{
    public function byPlanId($planId) {
        $this->andWhere(['id' => $planId]);
        return $this;
    }
}

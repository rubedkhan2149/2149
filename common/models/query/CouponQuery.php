<?php

namespace common\models\query;

use Yii;


class CouponQuery extends \yii\db\ActiveQuery
{
    public function byStatus($status) {
        $this->andWhere(['status' => $status]);
        return $this;
    }
    public function byCouponCode($code)
    {
        $this->andWhere(['code' => $code]);
        return $this;
    }
    public function byCouponId($couponId)
    {
        $this->andWhere(['id' => $couponId]);
        return $this;
    }
}

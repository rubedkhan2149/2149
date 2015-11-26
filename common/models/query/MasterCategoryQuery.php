<?php

namespace common\models\query;

use Yii;


class MasterCategoryQuery extends \yii\db\ActiveQuery
{
    public function byStatus($status) {
        $this->andWhere(['status' => $status]);
        return $this;
    }
    public function byCategoryName($categoryName) {
        $this->andWhere(['category_name' => $categoryName]);
        return $this;
    }
    public function byCategoryId($categoryId) {
        $this->andWhere(['id' => $categoryId]);
        return $this;
    }
}

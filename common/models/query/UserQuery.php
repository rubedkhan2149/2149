<?php

namespace common\models\query;

use Yii;


class UserQuery extends \yii\db\ActiveQuery
{
    public function byUserId($id)
    {
        $this->andWhere(['id'=>$id]);
        return $this;
    }
    public function byUserNameOrEmail($value)
    {
        $this->where(['username'=>$value]);
        $this->orWhere(['email'=>$value]);
        return $this;
    }
    public function byRole($value)
    {
        $this->andWhere(['user_type'=>$value]);
        return $this;
    }
   
}

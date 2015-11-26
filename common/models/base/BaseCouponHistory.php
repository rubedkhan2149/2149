<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "coupon_history".
 *
 * @property string $id
 * @property string $coupon_id
 * @property string $txn_id
 * @property string $user_id
 * @property string $amount
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Coupon $coupon
 * @property UserTransaction $txn
 * @property User $user
 */
 class BaseCouponHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'coupon_history';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['coupon_id', 'txn_id', 'user_id', 'amount', 'created_at'], 'required'],
            [['coupon_id', 'txn_id', 'user_id'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'coupon_id' => 'Coupon ID',
            'txn_id' => 'Txn ID',
            'user_id' => 'User ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCoupon()
    {
        return $this->hasOne(Coupon::className(), ['id' => 'coupon_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTxn()
    {
        return $this->hasOne(UserTransaction::className(), ['id' => 'txn_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user_transaction".
 *
 * @property string $id
 * @property string $user_id
 * @property string $txn_id
 * @property string $amount
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CouponHistory[] $couponHistories
 * @property Subscription[] $subscriptions
 * @property User $user
 */
 class BaseUserTransaction extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['txn_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'txn_id' => 'Txn ID',
            'amount' => 'Amount',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCouponHistories()
    {
        return $this->hasMany(CouponHistory::className(), ['txn_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscription::className(), ['ut_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

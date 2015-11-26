<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "plan".
 *
 * @property string $id
 * @property string $plan_name
 * @property string $plan_type
 * @property integer $duration
 * @property string $amount
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Subscription[] $subscriptions
 */
 class BasePlan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['plan_type', 'status'], 'string'],
            [['duration'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['plan_name'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plan_name' => 'Plan Name',
            'plan_type' => 'Plan Type',
            'duration' => 'Duration',
            'amount' => 'Amount',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubscriptions()
    {
        return $this->hasMany(Subscription::className(), ['plan_id' => 'id']);
    }
}

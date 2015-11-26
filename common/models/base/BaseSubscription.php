<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "subscription".
 *
 * @property string $id
 * @property string $user_id
 * @property string $plan_id
 * @property string $ut_id
 * @property string $plan_desc
 * @property string $amount
 * @property string $start_date
 * @property string $end_date
 * @property string $prev_sub_id
 * @property string $created_at
 * @property string $updated_at
 *
 * @property UserTransaction $ut
 * @property Plan $plan
 * @property User $user
 */
 class BaseSubscription extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscription';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'plan_id', 'ut_id'], 'required'],
            [['user_id', 'plan_id', 'ut_id', 'prev_sub_id'], 'integer'],
            [['plan_desc'], 'string'],
            [['amount'], 'number'],
            [['start_date', 'end_date', 'created_at', 'updated_at'], 'safe']
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
            'plan_id' => 'Plan ID',
            'ut_id' => 'Ut ID',
            'plan_desc' => 'Plan Desc',
            'amount' => 'Amount',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'prev_sub_id' => 'Prev Sub ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUt()
    {
        return $this->hasOne(UserTransaction::className(), ['id' => 'ut_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlan()
    {
        return $this->hasOne(Plan::className(), ['id' => 'plan_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "master_state".
 *
 * @property integer $id
 * @property string $country_id
 * @property string $state_name
 * @property string $state_code
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
 class BaseMasterState extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_state';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'state_name'], 'required'],
            [['country_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['state_name'], 'string', 'max' => 128],
            [['state_code'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'state_name' => 'State Name',
            'state_code' => 'State Code',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

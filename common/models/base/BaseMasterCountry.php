<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "master_country".
 *
 * @property string $country_id
 * @property string $country_name
 * @property string $country_code
 * @property string $iso_code_3
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
 class BaseMasterCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'master_country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['country_name', 'country_code', 'iso_code_3'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'country_id' => 'Country ID',
            'country_name' => 'Country Name',
            'country_code' => 'Country Code',
            'iso_code_3' => 'Iso Code 3',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

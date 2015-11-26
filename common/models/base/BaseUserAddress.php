<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user_address".
 *
 * @property string $id
 * @property string $user_id
 * @property string $address_line1
 * @property string $address_line2
 * @property integer $country_id
 * @property integer $state_id
 * @property string $city
 * @property string $zipcode
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
 class BaseUserAddress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_address';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'country_id', 'state_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['address_line1', 'address_line2'], 'string', 'max' => 255],
            [['city'], 'string', 'max' => 100],
            [['zipcode'], 'string', 'max' => 50]
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
            'address_line1' => 'Address Line1',
            'address_line2' => 'Address Line2',
            'country_id' => 'Country ID',
            'state_id' => 'State ID',
            'city' => 'City',
            'zipcode' => 'Zipcode',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}

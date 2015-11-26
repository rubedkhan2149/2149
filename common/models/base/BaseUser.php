<?php

namespace common\models\base;

use Yii;
/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $user_type
 * @property string $ip
 * @property string $username
 * @property string $email
 * @property string $ud_password
 * @property string $ud_temp_password
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Comment[] $comments
 * @property UserAddress[] $userAddresses
 * @property UserAnswer[] $userAnswers
 * @property UserFlag[] $userFlags
 * @property UserProfile[] $userProfiles
 */
 class BaseUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_type', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['ip', 'email', 'ud_password', 'ud_temp_password'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 10]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_type' => 'User Type',
            'ip' => 'Ip',
            'username' => 'Username',
            'email' => 'Email',
            'ud_password' => 'Ud Password',
            'ud_temp_password' => 'Ud Temp Password',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasMany(Comment::className(), ['from_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAddresse()
    {
        return $this->hasMany(UserAddress::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserAnswer()
    {
        return $this->hasMany(UserAnswer::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFlag()
    {
        return $this->hasMany(UserFlag::className(), ['from_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(\common\models\UserProfile::className(), ['user_id' => 'id']);
    }
}

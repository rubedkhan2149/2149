<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property string $id
 * @property string $user_id
 * @property string $first_name
 * @property string $last_name
 * @property string $profile_image
 * @property string $edu_level
 * @property string $upcoming_exam
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
 class BaseUserProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['edu_level', 'upcoming_exam', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['first_name'], 'string', 'max' => 20],
            [['last_name'], 'string', 'max' => 30],
            [['profile_image'], 'string', 'max' => 255]
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'profile_image' => 'Profile Image',
            'edu_level' => 'Edu Level',
            'upcoming_exam' => 'Upcoming Exam',
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

<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user_detail".
 *
 * @property integer $ud_id
 * @property integer $fk_mur_id
 * @property string $ud_username
 * @property string $ud_first_name
 * @property string $ud_last_name
 * @property string $ud_full_name
 * @property string $ud_slug
 * @property string $ud_email
 * @property string $ud_image
 * @property string $ud_password
 * @property string $ud_temp_password
 * @property string $ud_education_label
 * @property string $ud_upcoming_exam
 * @property integer $ud_enabled
 * @property integer $ud_deleted
 * @property string $ud_created_date
 * @property string $ud_updated_date
 *
 * @property MasterUserRole $fkMur
 */
class UserDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_detail';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fk_mur_id'], 'required'],
            [['fk_mur_id', 'ud_enabled', 'ud_deleted'], 'integer'],
            [['ud_created_date', 'ud_updated_date'], 'safe'],
            [['ud_username', 'ud_first_name', 'ud_last_name', 'ud_full_name', 'ud_slug', 'ud_email', 'ud_image', 'ud_password', 'ud_temp_password', 'ud_education_label', 'ud_upcoming_exam'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ud_id' => 'Ud ID',
            'fk_mur_id' => 'Fk Mur ID',
            'ud_username' => 'Ud Username',
            'ud_first_name' => 'Ud First Name',
            'ud_last_name' => 'Ud Last Name',
            'ud_full_name' => 'Ud Full Name',
            'ud_slug' => 'Ud Slug',
            'ud_email' => 'Ud Email',
            'ud_image' => 'Ud Image',
            'ud_password' => 'Ud Password',
            'ud_temp_password' => 'Ud Temp Password',
            'ud_education_label' => 'Ud Education Label',
            'ud_upcoming_exam' => 'Ud Upcoming Exam',
            'ud_enabled' => 'Ud Enabled',
            'ud_deleted' => 'Ud Deleted',
            'ud_created_date' => 'Ud Created Date',
            'ud_updated_date' => 'Ud Updated Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFkMur()
    {
        return $this->hasOne(MasterUserRole::className(), ['mur_id' => 'fk_mur_id']);
    }
}

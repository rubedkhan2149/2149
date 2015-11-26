<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "email_template".
 *
 * @property string $id
 * @property string $title
 * @property string $show_title
 * @property string $content
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 */
 class BaseEmailTemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['title', 'show_title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'show_title' => 'Show Title',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}

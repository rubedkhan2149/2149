<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "exam".
 *
 * @property string $id
 * @property string $category_id
 * @property string $exam_name
 * @property string $exam_slug
 * @property string $meta_title
 * @property string $meta_desc
 * @property string $meta_keyword
 * @property string $status
 * @property string $created_at
 * @property string $updated_at
 *
 * @property MasterCategory $category
 * @property ExamExperience[] $examExperiences
 * @property ExamSection[] $examSections
 * @property ExamType[] $examTypes
 * @property Product[] $products
 */
 class BaseExam extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'exam';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['exam_name'], 'string', 'max' => 30],
            [['exam_slug'], 'string', 'max' => 100],
            [['meta_title', 'meta_desc', 'meta_keyword'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'exam_name' => 'Exam Name',
            'exam_slug' => 'Exam Slug',
            'meta_title' => 'Meta Title',
            'meta_desc' => 'Meta Desc',
            'meta_keyword' => 'Meta Keyword',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(MasterCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamExperiences()
    {
        return $this->hasMany(ExamExperience::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamSections()
    {
        return $this->hasMany(ExamSection::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamTypes()
    {
        return $this->hasMany(ExamType::className(), ['exam_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['exam_id' => 'id']);
    }
}

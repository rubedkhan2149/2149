<?php
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ExamForm extends Model
{
    public $exam_name;
    public $exam_slug;
    public $category_id;
    public $meta_title;
    public $meta_desc;
    public $meta_keyword;
    public $exam_type;
    public $exam_section;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['exam_name'], 'required'],
            [['category_id'], 'integer'],
            [['exam_name'], 'string', 'max' => 30],
            [['exam_slug'], 'string', 'max' => 100],
            [['meta_title', 'meta_desc', 'meta_keyword'], 'string', 'max' => 255],
            [['exam_type', 'exam_section'], 'safe']
        ];
    }
public function attributeLabels()
    {
        return [
            'category_id' => 'Category ID',
            'exam_name' => 'Exam Name',
            'exam_slug' => 'Exam Slug',
            'meta_title' => 'Meta Title',
            'meta_desc' => 'Meta Description',
            'meta_keyword' => 'Meta Keyword',
            'exam_type' => 'Exam Type',
            'exam_section' => 'Exam Section',
        ];
    }
    
    public function addExam() {
        
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();
//            \yii\helpers\VarDumper::dump($this->exam_type,10,true); die;
            try
            {
                
                $exam = $this->saveExam();
                $this->saveExamType($exam);
                $this->saveExamSection($exam);
                
                if ($this->hasErrors(NULL)) {
                    throw new \Exception;
                }

                $valid = true;
                $transaction->commit();
                return array('success'=> true,'data'=>  $this);
            }
            catch (\Exception $e)
            {
                    $this->addError('misc', $e->getMessage());
                
                $transaction->rollBack();
                return array('success'=> false, 'error' => $e->getMessage());
            }
    }
    public function editExam($id) {
        
            $connection = Yii::$app->db;
            $transaction = $connection->beginTransaction();
//            \yii\helpers\VarDumper::dump($this->exam_type,10,true); die;
            try
            {
                
                $exam = $this->updateExam($id);
                $this->saveExamType($exam);
                $this->saveExamSection($exam);
                
                if ($this->hasErrors(NULL)) {
                    throw new \Exception;
                }

                $valid = true;
                $transaction->commit();
                return array('success'=> true,'data'=>  $this);
            }
            catch (\Exception $e)
            {
                    $this->addError('misc', $e->getMessage());
                
                $transaction->rollBack();
                return array('success'=> false, 'error' => $e->getMessage());
            }
    }
    
    public function saveExam() 
    {
        $model = new Exam();
        $model->attributes = $this->attributes;
      
        if ($model->validate())
        {
           
            $model->save();
        }
        else
        {
            foreach ($model->errors as $key => $value) {
                    $this->addError($key, $model->getFirstError($key));
                }
        }

        return $model;
    }
    public function updateExam($id) 
    {
        $model = Exam::findOne(['id'=>$id]);
        $model->attributes = $this->attributes;
      
        if ($model->validate())
        {
           
            $model->save();
        }
        else
        {
            foreach ($model->errors as $key => $value) {
                    $this->addError($key, $model->getFirstError($key));
                }
        }

        return $model;
    }
    
    public function saveExamType($exam) 
    {
        
        $exam_type = $this->exam_type;
        foreach ($exam_type as $value) {
            $model = new ExamType();
            $model->name=$value;
            $model->exam_id = $exam->id;
            $res=ExamType::findOne(['name'=>$value,'exam_id'=>$exam->id]);
            
            if ($model->validate())
            {
                if(empty($res)){
                    $model->save();
                }
            }
            else
            {
                foreach ($model->errors as $key => $value) 
                {
                    $this->addError($key, $model->getFirstError($key));
                }
            }
        }
        
        return $model;
    }
    
    public function saveExamSection($exam) 
    {
        
        $exam_section = $this->exam_section;
        foreach ($exam_section as $value) {
            $model = new ExamSection();
            $model->name=$value;
            $model->exam_id = $exam->id;
            $res=  ExamSection::findOne(['name'=>$value,'exam_id'=>$exam->id]);
            if ($model->validate())
            {
                if(empty($res)){
                    $model->save();
                }
            }
            else
            {
                foreach ($model->errors as $key => $value) 
                {
                    $this->addError($key, $model->getFirstError($key));
                }
            }
        }
        
        return $model;
    }
    
}

<?php

namespace common\models;

use Yii;
use common\models\base\BaseExam;
use common\models\query\ExamQuery;
use yii\helpers\ArrayHelper;

 class Exam extends BaseExam{
    public static function find()
    {
        return new ExamQuery(get_called_class());
    }
    
     public function rules() {
        return ArrayHelper::merge(
            parent::rules(),
            [
                   
                ]);
       }
       
       public function attributeLabels() {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                    
                ]);
       }
       
        public function behaviors()
         {
             return [
                 'timestamp' => [
                        'class' => \yii\behaviors\TimestampBehavior::className(),
                        'createdAtAttribute' => 'created_at',
                        'updatedAtAttribute' => 'updated_at',
                        'value' => new \yii\db\Expression('NOW()'),
                     'attributes' => [
                         \yii\db\ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                         \yii\db\ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                     ],
                 ],
             ];
         }
       
       public static function searchExam($param)
        {
            $where = "WHERE status!=:status";
            $params = [':status' => 'deleted'];
            if(!empty($param['txtSearch']))
            {
               $where.=" AND exam_name LIKE :examname";
               $params[':examname']="%{$param['txtSearch']}%";
            }

            $sql = "SELECT * FROM exam {$where}";
            $countQuery = \yii::$app->db->createCommand($sql,$params)->query();
            $count = $countQuery->rowCount;

            $dataProvider = new \yii\data\SqlDataProvider([
                                'sql'        => $sql,
                                'params'     => $params,
                                'totalCount' => $count,
                                'pagination' => [
                                                    'pageSize'   => 5,
                                                ],
                            ]);
            return $dataProvider;
        }
        
        public function changeStatus() {
            if($this->save()){
                return true;
            }else{
                return false;
            }
        }
}

<?php

namespace common\models;

use Yii;
use common\models\base\BaseMasterCategory;
use common\models\query\MasterCategoryQuery;
use yii\helpers\ArrayHelper;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
class MasterCategory extends BaseMasterCategory {

    public static function find()
    {
        return new MasterCategoryQuery(get_called_class());
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['parent_id'], 'integer'],
            [['status'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['category_name'], 'string', 'max' => 30],
            [['category_name'], 'required'],
            ['category_name', 'categoryexist']
        ];
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(
                parent::attributeLabels(), [
        ]);
    }
    
    
    public static function searchCategory($param)
    {
        $where = "WHERE cat.status!=:status";
        $params = [':status' => 'deleted'];
        if(!empty($param['txtSearch']))
        {
           $where.=" AND cat.category_name LIKE :catname";
           $params[':catname']="%{$param['txtSearch']}%";
        }
        
        $sql = "SELECT cat.id,
                cat.category_name,
                parent.category_name as parent_category,
                cat.status,
                cat.created_at
                FROM master_category cat
                LEFT JOIN master_category parent
                ON cat.parent_id = parent.id
                {$where}
                ORDER BY cat.category_name ASC";
               
        $countSql = "SELECT COUNT(cat.id)
                    FROM master_category cat
                    LEFT JOIN master_category parent
                    ON cat.parent_id = parent.id
                    {$where}
                    ORDER BY cat.category_name ASC";
        
        $count = \yii::$app->db->createCommand($countSql,$params)->queryScalar();

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
    
    public static function getcategoryList()
    {
        $data = self::find()->byStatus('active')->all();
        return ArrayHelper::map($data,'id', 'category_name');
    }
    
    public function createCategory()
    {
        if($this->save(false))
        { 
            return true;
        }
        else
        {
            return false;
        }
    }
    public function categoryexist() 
    {
        $category =  self::find()->byCategoryName($this->category_name)->byStatus('active')->one();
        if (empty($category)) 
        {
            return true;
        } 
        else 
        {
            echo json_encode(array("response"=>"error","message"=>"Category already exists."));
            exit;
        }
    }
    public function getcategoryById($categoryId)
    {
        $category = self::find()->byCategoryId($categoryId)->one();
        return $category;
    }
    public function deleteCategory($categoryId)
    {
        $category = self::find()->byCategoryId($categoryId)->one();
        $category->status = 'deleted';
        if($category->save(false))
        { 
            return true;
        }
        else
        {
            return false;
        }
        
    }
}

<?php

namespace common\models;

use Yii;
use common\models\base\BasePlan;
use common\models\query\PlanQuery;
use yii\helpers\ArrayHelper;

class Plan extends BasePlan
{
    public static function find()
    {
        return new PlanQuery(get_called_class());
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
       
    public static function searchPlan($param)
    {
        $where = "WHERE status!=:status";
        $params = [':status' => 'deleted'];
        if(!empty($param['txtSearch']))
        {
           $where.=" AND paln_name LIKE :planname";
           $params[':planname']="%{$param['txtSearch']}%";
        }
        
        $sql = "SELECT id,plan_name,plan_type,duration,amount,status,created_at FROM plan
                {$where}
                ORDER BY plan_name ASC";
               
        $countSql = "SELECT COUNT(id)
                    FROM plan
                    {$where}
                    ORDER BY plan_name ASC";
        
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
    
    public function createPlan()
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
    
    public function getplanById($planId)
    {
        $plan = self::find()->byPlanId($planId)->one();
        return $plan;
    }
}

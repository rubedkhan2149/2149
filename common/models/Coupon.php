<?php

namespace common\models;

use Yii;
use common\models\base\BaseCoupon;
use common\models\query\CouponQuery;
use yii\helpers\ArrayHelper;

 class Coupon extends BaseCoupon{
    public static function find()
    {
        return new CouponQuery(get_called_class());
    }
    
     public function rules() {
        return ArrayHelper::merge(
            parent::rules(),
            [
                ['code', 'codeexist']
                ]);
       }
       
       public function attributeLabels() {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                    
                ]);
       }
       
       public function applyCode($code) 
       {
           $data=self::findOne(['code'=>$code,'status'=>'active']);
           if(empty($data)){
               $res=array('success' => false, 'data' => [], 'error' => 'Invalid Code', 'error_code'=>'not found');
           }else{
               $coupanHistory = "SELECT count(*) FROM `coupon_history`  WHERE coupon_id={$data->id}";
               $count = \yii::$app->db->createCommand($coupanHistory)->queryScalar();
               
               if($count<$data->uses_total){
                   $result=[];
                   foreach ($data as $key=>$value) {
                       $result[$key]=$value;
                   }
                   $res=array('success' => true, 'data' => $result, 'error' => '', 'error_code'=>'');
                   
               }else{
                   $res=array('success' => false, 'data' => [], 'error' => 'Invalid Code', 'error_code'=>'exceed');
               }
           }
           
           return $res;
       }
       
      public static function searchCoupons($param)
      {
        $where = "WHERE status!=:status";
        $params = [':status' => 'deleted'];
        if(!empty($param['txtSearch']))
        {
           $where.=" AND name LIKE :name";
           $params[':name']="%{$param['txtSearch']}%";
        }
        
        $sql = "SELECT id,name,code,type,discount,uses_total,end_date,status
                FROM coupon
                {$where}
                ORDER BY id DESC";
               
        $countSql = "SELECT COUNT(id)
                    FROM coupon
                    {$where}";
        
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
    public function createCoupon()
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
    public function codeexist() 
    {
        $code =  self::find()->byCouponCode($this->code)->byStatus('active')->one();
        if (empty($code)) 
        {
            return true;
        } 
        else 
        {
           $this->addError('code', 'Code Already Exist'); 
           return false;
        }
    }
    public function getcouponById($couponId)
    {
        $coupon = self::find()->byCouponId($couponId)->byStatus('active')->one();
        return $coupon;
    }
}

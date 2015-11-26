<?php
namespace backend\controllers;
use common\models\Coupon;
use yii\web\JsonParser;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
class CouponsController extends \backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionList()
    {
       $search = \yii::$app->request->post();
       $dataProvider = Coupon::searchCoupons($search);
        return $this->renderPartial('_list',[
            'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionAddCoupon()
    {
        $coupons = new Coupon();
        if(\Yii::$app->request->get('id')!='')
        {
            $couponId = \Yii::$app->request->get('id');
            $coupons  = $coupons->getcouponById($couponId);
        }
        if($coupons->load(\Yii::$app->request->post()) && $coupons->validate())
        {
            $coupons->start_date = date("Y-m-d");
            $coupons->end_date   = date("Y-m-d",  strtotime($coupons->end_date));
            $coupons->created_at = date("Y-m-d H:i:s");
            if ($coupon = $coupons->createCoupon()) 
            {
                return $this->redirect(['index']);
            }
            else
            {
                return $this->render('_addcoupons', [
                                        'coupons' => $coupons
                            ]);
            }
        }
        return $this->render('_addcoupons',[
            'coupons' => $coupons
        ]);
    }
    
    public function actionDeleteCoupon()
    {
        $coupons = new Coupon();
        if(\Yii::$app->request->post('coupon_id')!='')
        {
            $coupons->deleteCoupon(\Yii::$app->request->post('coupon_id'));
            return $this->redirect(['index']);
        }
    }
}

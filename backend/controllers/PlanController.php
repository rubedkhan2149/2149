<?php
namespace backend\controllers;
use common\models\Plan;
use yii\web\JsonParser;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
class PlanController extends \backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionList()
    {
       $search = \yii::$app->request->post();
       $dataProvider = Plan::searchPlan($search);
        return $this->renderPartial('_list',[
            'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionUpdatePlan()
    {
        $plan = new Plan();
        if(\Yii::$app->request->get('plan_id')!='')
        {
            $planId = \Yii::$app->request->get('plan_id');
            $plan = $plan->getplanById($planId);
        }
        if($plan->load(\Yii::$app->request->post()) && $plan->validate())
        {
            if ($plans = $plan->createPlan()) 
            {
                return $this->redirect(['index']);
            }
            else
            {
                return $this->render('_editplans', [
                                        'plan' => $plan
                            ]);
            }
        }
        return $this->renderPartial('_editplans',[
            'plan' => $plan
        ]);
    }
    public function actionDeletePlan()
    {
        $plan = new Plan();
        if(\Yii::$app->request->post('plan_id')!='')
        {
            $plan->deletePlan(\Yii::$app->request->post('plan_id'));
            return $this->redirect(['index']);
        }
    }
}

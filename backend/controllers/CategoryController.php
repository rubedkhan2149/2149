<?php
namespace backend\controllers;
use common\models\MasterCategory;
use yii\web\JsonParser;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
class CategoryController extends \backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionList()
    {
       $search = \yii::$app->request->post();
       $dataProvider = \common\models\MasterCategory::searchCategory($search);
        return $this->renderPartial('_list',[
            'dataProvider' => $dataProvider
        ]);
    }
    
    public function actionAddCategory()
    {
        $masterCategory = new MasterCategory();
        if(\Yii::$app->request->get('category_id')!='')
        {
            $categoryId = \Yii::$app->request->get('category_id');
            $masterCategory = $masterCategory->getcategoryById($categoryId);
        }
        if($masterCategory->load(\Yii::$app->request->post()) && $masterCategory->validate())
        {
//            if (Yii::$app->request->isAjax) 
//            {
//               Yii::$app->response->format = Response::FORMAT_JSON;
//               return ActiveForm::validate($masterCategory);
//            }
            if ($category = $masterCategory->createCategory()) 
            {
                return $this->redirect(['index']);
            }
            else
            {
                return $this->render('_addcategory', [
                                        'masterCategory' => $masterCategory
                            ]);
            }
        }
        return $this->renderPartial('_addcategory',[
            'masterCategory' => $masterCategory
        ]);
    }
    public function actionDeleteCategory()
    {
        $masterCategory = new MasterCategory();
        if(\Yii::$app->request->post('category_id')!='')
        {
            $masterCategory->deleteCategory(\Yii::$app->request->post('category_id'));
            return $this->redirect(['index']);
        }
    }
}

<?php
namespace backend\controllers;
use common\models\Exam;
use yii\web\JsonParser;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
class ExamController extends \backend\components\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionList()
    {
       $search = \yii::$app->request->post();
       $dataProvider = Exam::searchExam($search);
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
    
    public function actionAddExam()
    {
        $model=new \common\models\ExamForm();
        
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) 
        {
            \yii\helpers\VarDumper::dump(\Yii::$app->request->post(),10,true); die;
              $model->addExam();
              \Yii::$app->session->setFlash('success', 'Exam Added Successfully');
                          return $this->redirect(['/exam']);
            
        }
        
        return $this->render('add-exam', [
                            'model' => $model
                ]);
    }
    
    public function actionEditExam($id)
    {
        $exam=  Exam::findOne(['id'=>$id]);
        
        $examType=  \common\models\ExamType::findAll(['exam_id'=>$id]);
        
        $examTypeArr=[];
        if(!empty($examType)){
            foreach ($examType as $examTypeVal) {
                $examTypeArr[]=$examTypeVal['name'];
            }
        }
        
        $examSec= \common\models\ExamSection::findAll(['exam_id'=>$id]);
        $examSecArr=[];
        if(!empty($examSec)){
            foreach ($examSec as $examSecVal) {
                $examSecArr[]=$examSecVal['name'];
            }
        }
        
        $model=new \common\models\ExamForm();
        $model->attributes=$exam->attributes;
        
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) 
        {
              $model->editExam($id);
              \Yii::$app->session->setFlash('success', 'Exam Added Successfully');
                          return $this->redirect(['/exam']);
            
        }
        
        return $this->render('edit-exam', [
                            'model' => $model,
                            'examTypeArr' => $examTypeArr,
                            'examSecArr' => $examSecArr
                ]);
    }
    
    public function actionChangeStatus() {
        $examId=\Yii::$app->request->post('examId');
        $status=\Yii::$app->request->post('status');
        $model= Exam::findOne(['id'=>$examId]);
        $model->status=$status;
              if($model->changeStatus()){
                  return true;
              }else{
                  return false;
              }
    }
}

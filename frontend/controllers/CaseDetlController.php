<?php

namespace frontend\controllers;

use Yii;
use frontend\models\CaseDetl;
use app\models\CaseStatusMast;
use app\models\CaseMast;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CaseDetlController implements the CRUD actions for CaseDetl model.
 */
class CaseDetlController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CaseDetl models.
     * @return mixed
     */
    public function actionIndex()
    {
        $case_id = Yii::$app->getRequest()->getQueryParam('id');
        $this->layout = 'InnerPage';
        $model = CaseMast::find()
        ->where('id = :case_id', [':case_id' => $case_id])
        ->one();

        $caseStatus = new CaseStatusMast;

        $model->case_status_desc = $caseStatus->getStatus($model->case_status);
       
        $dataProvider = new ActiveDataProvider([
            'query' => CaseDetl::find()
             ->where('case_id = :case_id', [':case_id' => $case_id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
        ]);
    }

    /**
     * Displays a single CaseDetl model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CaseDetl model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CaseDetl();
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $user_id = Yii::$app->user->identity->id;

        $casemast = CaseMast::find()
        ->where('Id = :Id')
        ->addParams([':Id' => $id])
        ->one();

        $model->case_id = $casemast->Id;
        $model->cust_id = $casemast->custid;
        $model->userid = $user_id;  
        if($model->load(Yii::$app->request->post())){
          //print_r($_POST['CaseDetl']);
          //exit;
        $case_detail = $_POST['CaseDetl'];     
        $model->hearing_date = $case_detail['hearing_date'];
        $model->start_time =  $_POST['start_time'];
        $model->lawyers_name = $case_detail['lawyers_name'];
        $model->judges_name =  $case_detail['judges_name'];    
        $model->next_hearing_date = $case_detail['next_hearing_date'];
        $model->case_charged =  $case_detail['case_charged'];
        $model->case_notes = $case_detail['case_notes'];
         // echo $start_time;
          //exit();

       if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //echo "<pre>";
            //print_r($model);      

            return $this->redirect(['case-detl/index', 'id' => $model->case_id]);
        } else {
            echo "Error in saving the data";

        }
    }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CaseDetl model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->tran_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CaseDetl model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = new CaseDetl;
        $casedetl = $model->getCaseId($id); 
        $caseid = $casedetl;
        $this->findModel($id)->delete();
       
        return $this->redirect(['index?id='.$caseid]);
        /* return $this->render('create', [
            'model' => $casemast,
        ]); */
    }

    /**
     * Finds the CaseDetl model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CaseDetl the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CaseDetl::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

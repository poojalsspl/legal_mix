<?php

namespace frontend\controllers;

use Yii;
use app\models\CaseDoc;
use app\models\DocTypeMast;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CaseStatusMast;
use app\models\CaseMast;
use yii\helpers\ArrayHelper;

/**
 * CaseDocController implements the CRUD actions for CaseDoc model.
 */
class CaseDocController extends Controller
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
     * Lists all CaseDoc models.
     * @return mixed
     
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => CaseDoc::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }*/

     public function actionIndex()
     {
        $doctype = ArrayHelper::map(DocTypeMast::find()->all(), 'doc_type_id', 'doc_type_name');

        $case_id = Yii::$app->getRequest()->getQueryParam('id');
        $this->layout = 'sidebar';
        $model = CaseMast::find()
        ->where('id = :case_id', [':case_id' => $case_id])
        ->one();

        $caseStatus = new CaseStatusMast;

        $model->case_status_desc = $caseStatus->getStatus($model->case_status);
       
        $dataProvider = new ActiveDataProvider([
            'query' => CaseDoc::find()
             ->where('case_id = :case_id', [':case_id' => $case_id]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model' => $model,
            'doctype' => $doctype,
        ]);
    }

    /**
     * Displays a single CaseDoc model.
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
     * Creates a new CaseDoc model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     
    public function actionCreate()
    {
        $model = new CaseDoc();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    */

     public function actionCreate()
     {
        $model = new CaseDoc();
        $id = Yii::$app->getRequest()->getQueryParam('id');
        $user_id = Yii::$app->user->identity->id;

        $casemast = CaseMast::find()
        ->where('Id = :Id')
        ->addParams([':Id' => $id])
        ->one();

        $model->case_id = $casemast->Id;
        $model->cust_id = $casemast->cust_id;
        $model->userid = $user_id;  
        if($model->load(Yii::$app->request->post())){
            
        $case_detail = $_POST['CaseDoc'];     
        $model->doc_type_id = $case_detail['doc_type_id'];
        $model->doc_url =  $case_detail['doc_url'];
        

       if ($model->save()) {
            return $this->redirect(['case-doc/index', 'id' => $model->case_id]);
        } else {
            echo "Error in saving the data";

        }
    }

        return $this->renderAjax('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CaseDoc model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CaseDoc model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CaseDoc model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CaseDoc the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CaseDoc::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

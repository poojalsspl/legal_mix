<?php
namespace frontend\controllers;
use Yii;
use app\models\CaseMast;
use frontend\models\CaseDetl;
use app\models\CaseDoc;
use app\models\CaseMastSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CaseMastController implements the CRUD actions for CaseMast model.
 */
class CaseMastController extends Controller
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
     * Lists all CaseMast models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'InnerPage';
        $searchModel = new CaseMastSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
      
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CaseMast model.
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

    public function actionCasedocs()
    {
        $model = new CaseDoc();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('case_docs', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new CaseMast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'InnerPage';
        $user_id = Yii::$app->user->identity->id;
        $model = new CaseMast();
        $model->userid = $user_id;

        //echo "<pre>";
        //print_r($_POST);
        //exit;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //$model->custid = $_POST['cust_id'];
            $model->save();
            return $this->redirect(['view', 'id' => $model->Id]);
        }

        return $this->render('create', [
            'model' => $model,

        ]);
    }

    public function actionCasehearing()
    {
        $case_id = Yii::$app->getRequest()->getQueryParam('id');
        
        $this->layout = 'InnerPage';
        $user_id = Yii::$app->user->identity->id;
        $model = new CaseDetl();

       
        $model->userid = $user_id;


        if ($model->load(Yii::$app->request->post()) && $model->save())
        {
            return $this->redirect(['view', 'id' => $model->Id]);
        }
        return $this->renderAjax('hearing_details', [
            'model' => $model,
           
        ]);
    }

    /**
     * Updates an existing CaseMast model.
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
     * Deletes an existing CaseMast model.
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
     * Finds the CaseMast model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CaseMast the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CaseMast::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionCasedetail()
    {
        $this->layout = 'sidebar';
        $id = $_GET['id'];
       // $this->layout = 'InnerPage';
        $user_id = Yii::$app->user->identity->id;
        $model = CaseMast::find()
        ->where('Id = :Id')
        ->addParams([':Id' => $id])
        ->one();

        $casedetl = new CaseDetl();
        $model->userid = $user_id;
      
        return $this->render('index', [
            'dataProvider' => $casedetl,
        ]);
       
    } 

/* public function actionCasedetail()
    {
        $this->layout = 'sidebar';
        $id = $_GET['id'];
       // $this->layout = 'InnerPage';
        $user_id = Yii::$app->user->identity->id;
        $model = CaseMast::find()
        ->where('Id = :Id')
        ->addParams([':Id' => $id])
        ->one();

        $casedetl = new CaseDetl();
        $model->userid = $user_id;
        $casedocs = new CaseDoc();

      
        return $this->render('casedetail', [
            'model' => $model,
            'casedetl' =>  $casedetl,
            'casedocs' => $casedocs,
        ]);
       
    } */

}

<?php

namespace frontend\controllers;

use Yii;
use app\models\CustMast;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CustTypeMast;
use yii\web\UploadedFile;
use app\models\StateMast;
use app\models\CityMast;
use app\models\CustMastSearch;

/**
 * CustController implements the CRUD actions for CustMast model.
 */
class CustController extends Controller
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
     * Lists all CustMast models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'InnerPage';
        $user_id = Yii::$app->user->identity->id;
        $searchModel = new CustMastSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$user_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
       
     /*   $dataProvider = new ActiveDataProvider([
            'query' => CustMast::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
        */
    }

    /**
     * Displays a single CustMast model.
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
     * Creates a new CustMast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->layout = 'InnerPage';
        $model = new CustMast();
        $custType = new CustTypeMast();
        $cityModel = new CityMast();
        $stateModel = new StateMast();
         Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/uploads/';
        if ($model->load(Yii::$app->request->post())) {
        $cust_type_id = $model->cust_type_id;
        $value = $custType->getCustTypeName($cust_type_id); 
        $city_id = $model->city_code;
        $city_name = $cityModel->getCityName($city_id);  
        $model->city_name = $city_name;
        $state_id = $model->state_code;
        $state_name = $stateModel->getStateName($state_id);  
        $model->state_name = $state_name;
        //print_r($value);
        //exit;
        $model->userid = Yii::$app->user->identity->id;
        $model->regsdate =date('Y-m-d');
        $model->username = \Yii::$app->user->identity->username;
        $model->cust_status_id='1';
        $model->cust_status_name='Active';
        $model->cust_type_name = $value['cust_type_name'];
       
        //echo "<pre>";
        //print_r($model);
        //exit;s
        
        $image = UploadedFile::getInstance($model, 'custlogo');

        if($image != null){

          // store the source file name
          $model->custlogo = $image->name;

          $ext = end((explode(".", $image->name)));
          // generate a unique file name
          $model->file = $image->name;
          // the path to save file, you can set an uploadPath
          // in Yii::$app->params (as used in example below)
          $path = Yii::$app->params['uploadPath'] . $model->file;
          //echo $path;
          //exit;
          //code to upload the user image
          if ($model->file && $model->validate()) {                
             $image->saveAs($path);
            }
            else {
                echo "Image not uploaded";
            }
            
        }
        //echo "<pre>";
        //print_r($model);
        //exit;
        if ($model->save()) 
        {  
            return $this->redirect(['view', 'id' => $model->custid]);
        }
    }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing CustMast model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->custid]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing CustMast model.
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
     * Finds the CustMast model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CustMast the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CustMast::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
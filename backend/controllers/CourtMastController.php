<?php

namespace backend\controllers;

use Yii;
use backend\models\CourtMast;
use backend\models\CourtMastSearch;
use yii\web\Controller;
use backend\models\CountryMast;
use backend\models\StateMast;
use backend\models\CityMast;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;


/**
 * CourtMastController implements the CRUD actions for CourtMast model.
 */
class CourtMastController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all CourtMast models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CourtMastSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CourtMast model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CourtMast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CourtMast();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->court_code]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CourtMast model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->court_code]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionCountry($id)
    {
     $country = CountryMast::find()->where(['country_name'=>$id])->asArray()->one();
     $country_details['country'] = $country;
     $state = StateMast::find()->select("state_name,state_code")->where(['country_code'=>$country['country_code']])->asArray()->all();     
     $state_details['state']=$state;
    /*print_r($state);
     exit();*/
     $result1 = array_merge($country_details,$state_details);
     $result = Json::encode($result1);
     return $result;       
        //return $this->redirect(['index']);
    }
    public function actionState($id)
    {   
     $state = StateMast::find()->select("state_name,state_code")->where(['state_code'=>$id])->asArray()->one();
     $state_details['state'] = $state;
     $city = CityMast::find()->select("city_name,city_code")->where(['state_code'=>$state['state_code']])->asArray()->all();     
     $city_details['city']=$city;
    /*print_r($state);
     exit();*/
     $result1 = array_merge($state_details,$city_details);
     $result = Json::encode($result1);
     return $result;       


/*     $state = StateMast::find()->where(['state_code'=>$id])->asArray()->one();
     //$state = CityMast::find()->where(['state_code'=>$id])->asArray()->one();
     $result = Json::encode($state);
     return $result;       */
        //return $this->redirect(['index']);
    }


    /**
     * Deletes an existing CourtMast model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the CourtMast model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CourtMast the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CourtMast::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

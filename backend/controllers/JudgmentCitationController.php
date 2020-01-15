<?php

namespace backend\controllers;

use Yii;
use backend\models\JudgmentCitation;
use backend\models\JudgmentMast;
use backend\models\JudgmentCitationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\models\JournalMast;

/**
 * JudgmentCitationController implements the CRUD actions for JudgmentCitation model.
 */
class JudgmentCitationController extends Controller
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
     * Lists all JudgmentCitation models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JudgmentCitationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JudgmentCitation model.
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
     * Creates a new JudgmentCitation model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($jcount="",$jyear="",$jcode="")
    {
        $model = new JudgmentCitation();
        $check = JudgmentMast::find()->select('jcount,jyear,judgment_code')->where(['!=','jcount','completed'])->andWhere(['jyear'=>$jyear])->one();
            if(!empty($check))
            {
                $count = $check->jcount;
                $year = $check->jyear;               
            if($count==1){
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-act/create', 'jcount' => 2,'jyear'=>$year,'jcode'=>$judgment_code]);
            }
            elseif($count==2) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-advocate/create', 'jcount' => 2,'jyear'=>$year,'jcode'=>$judgment_code]);                 
            }
/*            elseif($count==3) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-citation/create', 'jcount' => 3,'jyear'=>$year,'jcode'=>$judgment_code]);                 
            }       */
            elseif($count==4) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-ext-remark/create', 'jcount' => 4,'jyear'=>$year,'jcode'=>$judgment_code]);                   
            }       
            elseif($count==5) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-judge/create', 'jcount' => 5,'jyear'=>$year,'jcode'=>$judgment_code]);                    
            }       
            elseif($count==6) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-parties/create', 'jcount' => 6,'jyear'=>$year,'jcode'=>$judgment_code]);                  
                } 
            elseif($count==7) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-overrules/create', 'jcount' => 7,'jyear'=>$year,'jcode'=>$jcode]);                  
                }
          elseif($count==8) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-overruledby/create', 'jcount' => 8,'jyear'=>$year,'jcode'=>$jcode]);                  
                } 
           elseif($count==9) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-ref/create', 'jcount' => 9,'jyear'=>$year,'jcode'=>$jcode]);                  
                }
            elseif($count==10) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-cited-by/create', 'jcount' => 10,'jyear'=>$year,'jcode'=>$jcode]);                  
                }                                                      
                                                                                         
            }
        if ($model->load(Yii::$app->request->post())) {
                //$judgment_code = $_POST['JudgmentCitation']['judgment_code']; 
                $model->judgment_code = $jcode;                 
                $model->save();                 
            if($jyear!="" && $jcount!=""){ 
                \Yii::$app->db->createCommand("UPDATE judgment_mast SET jcount=4 WHERE judgment_code=".$jcode."")->execute();
                Yii::$app->session->setFlash('Created successfully!!');
                return $this->redirect(['judgment-ext-remark/create', 'jcount' => 4,'jyear'=>$year,'jcode'=>$jcode ]);
                }
                else
                {
                return $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
                }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
        public function actionNextPage($jcode="",$jcount="",$jyear="")
    {
        \Yii::$app->db->createCommand("UPDATE judgment_mast SET jcount=4 WHERE judgment_code=".$jcode."")->execute();
        Yii::$app->session->setFlash('Created successfully!!');
            return $this->redirect(['judgment-ext-remark/create', 'jcount' => 4,'jyear'=>$jyear,'jcode'=>$jcode ]);
    }

    /**
     * Updates an existing JudgmentCitation model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($jcount="",$jyear="",$jcode="")
    {
        $model =  JudgmentCitation::find()->where(['judgment_code'=>$jcode])->one();    
        /*$model = $this->findModel($id);*/
        if($model->load(Yii::$app->request->post())) {
            $model->save();
                if($jyear!="" && $jcount!=""){ 
                    Yii::$app->getSession()->setFlash('success',' Updated Successfully'); 
                    return $this->redirect(['view', 'id' => $model->id]);
                }
                else{
                Yii::$app->session->setFlash('Updated successfully!!');
                 $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
                } 


        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    public function actionDeleteall($jcode)
    {
        \Yii::$app->db
    ->createCommand()
    ->delete('judgment_citation', ['judgment_code' =>$jcode])
    ->execute();
         Yii::$app->getSession()->setFlash('info','Deleted Successfully');      
    $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
    } 
    


    /**
     * Deletes an existing JudgmentCitation model.
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
     * Finds the JudgmentCitation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JudgmentCitation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JudgmentCitation::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
     public function actionJournal($id)
    {
     $journal = JournalMast::find()->select('shrt_name')->where(['journal_code'=>$id])->asArray()->one();
     $result = Json::encode($journal);
     return $result;       
        //return $this->redirect(['index']);
    }

}

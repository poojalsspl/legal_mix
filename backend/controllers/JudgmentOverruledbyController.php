<?php

namespace backend\controllers;

use Yii;
use backend\models\JudgmentOverruledby;
use backend\models\JudgmentMast;
use backend\models\JudgmentOverruledbySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JudgmentOverruledbyController implements the CRUD actions for JudgmentOverruledby model.
 */
class JudgmentOverruledbyController extends Controller
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
     * Lists all JudgmentOverruledby models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JudgmentOverruledbySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JudgmentOverruledby model.
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
     * Creates a new JudgmentOverruledby model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($jcount="",$jyear="",$jcode="")
    {
        $model = new JudgmentOverruledby;
                $check = JudgmentMast::find()->select('jcount,jyear,judgment_code')->where(['!=','jcount','completed'])->andWhere(['jyear'=>$jyear])->one();        
            if(!empty($check))
            {
                $count = $check->jcount;
                $year = $check->jyear;
               
            if($count==1){
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-act/create', 'jcount' => 2,'jyear'=>$year]);
            }
            if($count==2) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-advocate/create', 'jcount' => 2,'jyear'=>$year,'jcode'=>$jcode]);                 
            }
            elseif($count==3) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-citation/create', 'jcount' => 3,'jyear'=>$year,'jcode'=>$jcode]);                 
            }       
            elseif($count==4) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-ext-remark/create', 'jcount' => 4,'jyear'=>$year,'jcode'=>$jcode]);                   
            }       
            elseif($count==5) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-judge/create', 'jcount' => 5,'jyear'=>$year,'jcode'=>$jcode]);                    
            }       
            elseif($count==6) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-parties/create', 'jcount' => 6,'jyear'=>$year,'jcode'=>$jcode]);                  
                }
            elseif($count==7) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-overrules/create', 'jcount' => 7,'jyear'=>$year,'jcode'=>$jcode]);                  
                }
/*          elseif($count==8) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-overruledby/create', 'jcount' => 8,'jyear'=>$year,'jcode'=>$jcode]);                  
                }*/
           elseif($count==9) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-ref/create', 'jcount' => 9,'jyear'=>$year,'jcode'=>$jcode]);                  
                }
            elseif($count==10) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-cited-by/create', 'jcount' => 10,'jyear'=>$year,'jcode'=>$jcode]);                 
                }                                                           
            }
        return $this->render('create', [
                'model' => new JudgmentOverruledby,
            ]);
    }
    public function actionUpdate($jcount="",$jyear="",$jcode="")
    {
      return $this->render('update', [
                'model' => new JudgmentOverruledby,
            ]);
    }
    public function actionAdddata($id,$jcode)
    {
      $JudgmentOverruledby      = new JudgmentOverruledby();
      $JudgmentOverruledbyCheck = JudgmentOverruledby::find()->where(['judgment_code'=>$jcode,'over_ruledby_code'=>$id])->one();
      $judgmentMast           =  JudgmentMast::find()->select('judgment_code,judgment_title,court_name,jyear')->where(['judgment_code'=>$id])->one();

      $action = Yii::$app->controller->action->id;
      if(count($JudgmentOverruledbyCheck)>0){
        Yii::$app->getSession()->setFlash('danger','Already Exist'); 
        if($action=='create'){
                return $this->redirect(['judgment-overruledby/create','jcount'=>"7",'jyear'=>$judgmentMast->jyear,'jcode'=>$jcode]);
         }
         else{
          return $this->redirect(['judgment-overruledby/update','jcount'=>"",'jyear'=>$judgmentMast->jyear,'jcode'=>$jcode]);  
         }
      }
     $judgment_code                       =  $judgmentMast->judgment_code;
     $JudgmentOverruledby->judgment_code    =  $jcode;
     $JudgmentOverruledby->over_ruledby_code  =  $judgmentMast->judgment_code;
     $JudgmentOverruledby->over_ruledby_title =  $judgmentMast->judgment_title;
     $JudgmentOverruledby->save(false);
     Yii::$app->getSession()->setFlash('success','Created sucessfully');
             if($action=='create'){
                return $this->redirect(['judgment-overruledby/create','jcount'=>"7",'jyear'=>$judgmentMast->jyear,'jcode'=>$jcode]);
         }
         else{
          return $this->redirect(['judgment-overruledby/update','jcount'=>"",'jyear'=>$judgmentMast->jyear,'jcode'=>$jcode]);  
         }
    }
    public function actionDeleteall($jcode)
    {
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('judgment_overruledby', ['judgment_code' => $jcode])
            ->execute();
         Yii::$app->getSession()->setFlash('success','Deleted sucessfully');
        $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
    }
    public function actionNextPage($jcode="",$jcount="",$jyear="")
    {
        \Yii::$app->db->createCommand("UPDATE judgment_mast SET jcount='8' WHERE judgment_code=".$jcode."")->execute();
        Yii::$app->session->setFlash('Created successfully!!');
     return $this->redirect(['judgment-ref/create','jcount'=>"9",'jyear'=>$jyear,'jcode'=>$jcode]); 
    }
    public function actionSingledelete($id,$jyear,$jcode)
    {
     $this->findModel($id)->delete();
     $action = Yii::$app->controller->action->id;
     Yii::$app->getSession()->setFlash('danger','Deleted sucessfully');         
     if($action=='create'){
                return $this->redirect(['judgment-overruledby/create','jcount'=>"7",'jyear'=>$jyear,'jcode'=>$jcode]);
         }
         else{
          return $this->redirect(['judgment-overruledby/update','jcount'=>"",'jyear'=>$jyear,'jcode'=>$jcode]);  
         }   
    }    


    /**
     * Updates an existing JudgmentOverruledby model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate1($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing JudgmentOverruledby model.
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
     * Finds the JudgmentOverruledby model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JudgmentOverruledby the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JudgmentOverruledby::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

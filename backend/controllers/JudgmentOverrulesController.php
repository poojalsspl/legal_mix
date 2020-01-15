<?php

namespace backend\controllers;

use Yii;
use backend\models\JudgmentOverrules;
use backend\models\JudgmentMast;
use backend\models\JudgmentOverrulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JudgmentOverrulesController implements the CRUD actions for JudgmentOverrules model.
 */
class JudgmentOverrulesController extends Controller
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
     * Lists all JudgmentOverrules models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JudgmentOverrulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JudgmentOverrules model.
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
     * Creates a new JudgmentOverrules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($jcount="",$jyear="",$jcode="")
    {
        $model = new JudgmentOverrules;
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
/*            elseif($count==7) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-overrules/create', 'jcount' => 7,'jyear'=>$year,'jcode'=>$jcode]);                  
                }*/
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
        return $this->render('create', [
                'model' => new JudgmentOverrules,
            ]);
    }

    /**
     * Updates an existing JudgmentOverrules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($jcount="",$jyear="",$jcode="")
    {
      return $this->render('update', [
                'model' => new JudgmentOverrules,
            ]);
    }
    public function actionAdddata($id,$jcode)
    {
      $judgmentOverrules      = new JudgmentOverrules();
      $judgmentOverrulesCheck = JudgmentOverrules::find()->where(['judgment_code'=>$jcode,'over_rules_code'=>$id])->one();
      $judgmentMast           =  JudgmentMast::find()->select('judgment_code,judgment_title,court_name,jyear')->where(['judgment_code'=>$id])->one();

      $action = Yii::$app->controller->action->id;
      if(count($judgmentOverrulesCheck)>0){
        Yii::$app->getSession()->setFlash('danger','Already Exist'); 
        if($action=='create'){
                return $this->redirect(['judgment-overrules/create','jcount'=>"7",'jyear'=>$judgmentMast->jyear,'jcode'=>$jcode]);
         }
         else{
          return $this->redirect(['judgment-overrules/update','jcount'=>"",'jyear'=>$judgmentMast->jyear,'jcode'=>$jcode]);  
         }
      }
     $judgment_code                       =  $judgmentMast->judgment_code;
     $judgmentOverrules->judgment_code    =  $jcode;
     $judgmentOverrules->over_rules_code  =  $judgmentMast->judgment_code;
     $judgmentOverrules->over_rules_title =  $judgmentMast->judgment_title;
     $judgmentOverrules->save(false);
     Yii::$app->getSession()->setFlash('success','Created sucessfully');
             if($action=='create'){
                return $this->redirect(['judgment-overrules/create','jcount'=>"7",'jyear'=>$judgmentMast->jyear,'jcode'=>$jcode]);
         }
         else{
          return $this->redirect(['judgment-overrules/update','jcount'=>"",'jyear'=>$judgmentMast->jyear,'jcode'=>$jcode]);  
         }
    }
    public function actionDeleteall($jcode)
    {
        \Yii::$app
            ->db
            ->createCommand()
            ->delete('judgment_overrules', ['judgment_code' => $jcode])
            ->execute();
         Yii::$app->getSession()->setFlash('success','Deleted sucessfully');
        $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
    }
    public function actionNextPage($jcode="",$jcount="",$jyear="")
    {
        \Yii::$app->db->createCommand("UPDATE judgment_mast SET jcount='7' WHERE judgment_code=".$jcode."")->execute();
        Yii::$app->session->setFlash('Created successfully!!');
     return $this->redirect(['judgment-overruledby/create','jcount'=>"8",'jyear'=>$jyear,'jcode'=>$jcode]); 
    }



    /**
     * Deletes an existing JudgmentOverrules model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    public function actionSingledelete($id,$jyear,$jcode)
    {
     $this->findModel($id)->delete();
     $action = Yii::$app->controller->action->id;
     Yii::$app->getSession()->setFlash('danger','Deleted sucessfully');         
     if($action=='create'){
                return $this->redirect(['judgment-overrules/create','jcount'=>"7",'jyear'=>$jyear,'jcode'=>$jcode]);
         }
         else{
          return $this->redirect(['judgment-overrules/update','jcount'=>"",'jyear'=>$jyear,'jcode'=>$jcode]);  
         }   
     //return $this->redirect(['judgment-overruled-by/create','jcount'=>,'jyear'=>$jyear,'jcode'=>$jcode]);  
    }
    /**
     * Finds the JudgmentOverrules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JudgmentOverrules the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JudgmentOverrules::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

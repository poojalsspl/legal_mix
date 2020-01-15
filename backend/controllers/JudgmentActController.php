<?php

namespace backend\controllers;

use Yii;
use backend\models\JudgmentAct;
use backend\models\JudgmentMast;
use backend\models\JudgmentActSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * JudgmentActController implements the CRUD actions for JudgmentAct model.
 */
class JudgmentActController extends Controller
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
     * Lists all JudgmentAct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JudgmentActSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JudgmentAct model.
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
     * Creates a new JudgmentAct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * judgment-act/create?jcount=2&jyear=2010
     */
    public function actionCreate($jcount="",$jyear="",$jcode="")
    {
        
        $model = new JudgmentAct();
        $cache = Yii::$app->cache;
        $cache->set('judgment_code', $jcode);
        $check = JudgmentMast::find()->select('jcount,jyear,judgment_code')->where(['!=','jcount','completed'])->andWhere(['jyear'=>$jyear])->one();        
            if(!empty($check))
            {
                $count = $check->jcount;
                $year = $check->jyear;
               
/*            if($count==1){
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-act/create', 'jcount' => 2,'jyear'=>$year]);
            }*/
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

        if ($model->load(Yii::$app->request->post()) ) {
            $model->judgment_code = $jcode;
            $model->save(false);
               if($jyear!="" && $jcount!=""){ 
                \Yii::$app->db->createCommand("UPDATE judgment_mast SET jcount=2 WHERE judgment_code=".$judgment_code."")->execute();
                Yii::$app->session->setFlash('Created successfully!!');
                return $this->redirect(['judgment-advocate/create', 'jcount' => 2,'jyear'=>$year,'jcode'=>$jcode ]);
                }
                else{
                return $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
                }            
                //return $this->redirect(['view', 'id' => $model->jact]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionNextPage($jcode="",$jcount="",$jyear="")
    {
        \Yii::$app->db->createCommand("UPDATE judgment_mast SET jcount=2 WHERE judgment_code=".$jcode."")->execute();
        Yii::$app->session->setFlash('Created successfully!!');
        return $this->redirect(['judgment-advocate/create', 'jcount' => 2,'jyear'=>$jyear,'jcode'=>$jcode ]);           
    }
    public function actionDeleteall($jcode)
    {
        \Yii::$app->db
    ->createCommand()
    ->delete('judgment_act', ['judgment_code' =>$jcode])
    ->execute();
         Yii::$app->getSession()->setFlash('info','Deleted Successfully');      
    $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
    } 


    /**
     * Updates an existing JudgmentAct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($jcount="",$jyear="",$jcode="")
    {
        $model =  JudgmentAct::find()->where(['judgment_code'=>$jcode])->one();        
        //$model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
               if($jyear!="" && $jcount!=""){ 
            return $this->redirect(['view', 'id' => $model->jact]);               
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

    /**
     * Deletes an existing JudgmentAct model.
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
     * Finds the JudgmentAct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JudgmentAct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JudgmentAct::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

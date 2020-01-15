<?php

namespace backend\controllers;

use Yii;
use backend\models\JudgmentParties;
use backend\models\JudgmentMast;
use backend\models\JudgmentPartiesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * JudgmentPartiesController implements the CRUD actions for JudgmentParties model.
 */
class JudgmentPartiesController extends Controller
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
     * Lists all JudgmentParties models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JudgmentPartiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JudgmentParties model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionDeleteall($jcode)
    {
        \Yii::$app->db
    ->createCommand()
    ->delete('judgment_parties', ['judgment_code' =>$jcode])
    ->execute();
         Yii::$app->getSession()->setFlash('info','Deleted Successfully');      
    $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
    } 
    
    /**
     * Creates a new JudgmentParties model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($jcount="",$jyear="",$jcode="")
    {
        $model = new JudgmentParties();
            $check = JudgmentMast::find()->select('jcount,jyear,judgment_code')->where(['!=','jcount','completed'])->andWhere(['jyear'=>$jyear])->one();        
            if(!empty($check))
            {
                $count = $check->jcount;
                $year = $check->jyear;
               
            if($count==1){
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-act/create', 'jcount' => 1,'jyear'=>$year,'jcode'=>$jcode]);
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
/*            elseif($count==6) {
                Yii::$app->session->setFlash('Please Complete All Pages');
                return $this->redirect(['judgment-parties/create', 'jcount' => 6,'jyear'=>$year,'jcode'=>$jcode]);                  
                } 
                                                      */
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
/*            return $this->redirect(['view', 'id' => $model->judgment_party_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }*/
            $count =  count($_POST['JudgmentParties']['party_flag']);
            $judgmentParties = $jcode;
            $judgment_code = $jcode;

            for($i=0;$i<$count;$i++)
            {
            $model = new JudgmentParties();
            if($_POST['JudgmentParties']['party_name'][$i] !='')
            {
            $model->judgment_code  = $judgmentParties;
            $model->party_flag = $_POST['JudgmentParties']['party_flag'][$i];
            $model->party_name = $_POST['JudgmentParties']['party_name'][$i];            
            $model->save(); 
            }
            } 
                 if($jyear!="" && $jcount!=""){ 
                    \Yii::$app->db->createCommand("UPDATE judgment_mast SET jcount='7' WHERE judgment_code=".$judgment_code."")->execute();
                    return $this->redirect(['judgment-mast/']);
                    Yii::$app->session->setFlash('Created successfully!!');           
                }
                else{
                return $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
                }
                             


    }
    else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    public function actionNextPage($jcode="",$jcount="",$jyear="")
    {
        \Yii::$app->db->createCommand("UPDATE judgment_mast SET jcount='6' WHERE judgment_code=".$jcode."")->execute();
        Yii::$app->session->setFlash('Created successfully!!');
        return $this->redirect(['judgment-mast/']);        
    }

    /**
     * Updates an existing JudgmentParties model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($jcount="",$jyear="",$jcode="")
    {
        $model =  JudgmentParties::find()->where(['judgment_code'=>$jcode])->one();    
        //$model = $this->findModel($id);
        $judgmentAdvocate =$model->judgment_code;
        $adv = new JudgmentParties();
        if($adv->load(Yii::$app->request->post())) { 
         $count =  count($_POST['JudgmentParties']['party_flag']);       
            \Yii::$app
            ->db
            ->createCommand()
            ->delete('judgment_parties', ['judgment_code' => $jcode])
            ->execute();

            for($i=0;$i<$count;$i++)
            {
            if($_POST['JudgmentParties']['party_name'][$i] !='')
            {                
            /*if($_POST['JudgmentParties']['judgment_party_id'][$i] == '')
            {*/
               /* echo $_POST['JudgmentParties']['id'][$i];
                exit();*/
            $parties = new JudgmentParties();
            $parties->judgment_code  = $judgmentAdvocate;
            $parties->party_flag = $_POST['JudgmentParties']['party_flag'][$i];
            $parties->party_name = $_POST['JudgmentParties']['party_name'][$i];                        
            $parties->save(); 
         /*   }
            else
            {
            $parties = JudgmentParties::find()->where(['judgment_party_id'=>$_POST['JudgmentParties']['judgment_party_id'][$i]])->one();
            $parties->judgment_code  = $judgmentAdvocate;
            $parties->party_flag = $_POST['JudgmentParties']['party_flag'][$i];
            $parties->party_name = $_POST['JudgmentParties']['party_name'][$i];            
            //echo 'test';
            //exit();
            $parties->save(); 
            }*/
             }
            }
            //$model->save(); 
            if($jyear!="" && $jcount!=""){ 
            Yii::$app->getSession()->setFlash('success',' Updated Successfully'); 
            return $this->redirect(['index']);
                }
                else{
                Yii::$app->session->setFlash('Updated successfully!!');
                 $this->redirect(['judgment-mast/judgmentupdate', 'code'=>$jcode ]);                    
                } 
        }
         else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }

        

        /*if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->judgment_party_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }*/
    }

    /**
     * Deletes an existing JudgmentParties model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = JudgmentParties::findOne($id);
        \Yii::$app->db
    ->createCommand()
    ->delete('judgment_parties', ['judgment_code' =>$model->judgment_code])
    ->execute();
        Yii::$app->getSession()->setFlash('info','Deleted Successfully');      

        return $this->redirect(['index']);

    }
     public function actionDeleteOne($id)
    {

        $this->findModel($id)->delete();
        Yii::$app->getSession()->setFlash('info','Deleted Successfully');      
        return $this->redirect(['index']);
    }


    /**
     * Finds the JudgmentParties model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     *
     * @return JudgmentParties the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionParty($id)
    {
     $state = JudgmentMast::find()->select(['respondant_name','appellant_name'])->where(['judgment_code'=>$id])->asArray()->one();
     $result = Json::encode($state);
     return $result;       
        //return $this->redirect(['index']);
    }
    protected function findModel($id)
    {
        if (($model = JudgmentParties::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

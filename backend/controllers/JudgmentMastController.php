<?php

namespace backend\controllers;

use Yii;
use backend\models\JudgmentMast;
use backend\models\CourtMast;
use backend\models\CityMast;
use backend\models\JudgmentMastSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use backend\models\Categories;
use backend\models\JudgmentAct;
use backend\models\JudgmentAdvocate;
use backend\models\JudgmentCitation;
use backend\models\JudgmentExtRemark ;
use backend\models\JudgmentJudge;
use backend\models\JudgmentParties ;
use backend\models\JcatgMast ;
use backend\models\JsubCatgMast;
use yii\helpers\ArrayHelper;
use backend\models\JudgmentBenchType;
use backend\models\JudgmentDisposition;
use backend\models\JudgmentJurisdiction;




/**
 * JudgmentMastController implements the CRUD actions for JudgmentMast model.
 */
class JudgmentMastController extends Controller
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
                    //'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all JudgmentMast models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new JudgmentMastSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single JudgmentMast model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionJudgmentview($code="")
    {
        return $this->render('judgmentview');
    }


    /**
     * Creates a new JudgmentMast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($jcount="",$jyear="")
    {
     $model = new JudgmentMast();
     $cache                 = Yii::$app->cache;
     $courtMast             = ArrayHelper::map(CourtMast::find()->all(), 'court_code', 'court_name');
     $jcatg_description     = ArrayHelper::map(JcatgMast::find()->all(), 'jcatg_id', 'jcatg_description');
     $jsub_catg_description = ArrayHelper::map(JsubCatgMast::find()->all(), 'jsub_catg_id', 'jsub_catg_description');
         $cache->set('courtMast', $courtMast);
         $cache->set('jcatg_description', $jsub_catg_description);
         $cache->set('jsub_catg_description', $jsub_catg_description);
           
        if ($model->load(Yii::$app->request->post()) ) {

            $model->court_name                 =  $model->courtCode->court_name;
            $model->jcatg_description          =  $model->jcatg->jcatg_description;
            $model->jsub_catg_description      =  $model->jsubCatg->jsub_catg_description;
            $model->bench_type_text            =  $model->judgmentBenchType->bench_type_text;
            $model->disposition_text           =  $model->judgmentDisposition->disposition_text;
            $model->judgmnent_jurisdiction_text =  $model->judgmentJurisdiction->judgment_jurisdiction_text;
            $model->appeal_numb           = $_POST['JudgmentMast']['appeal_numb'];
            $model->appellant_name        = $_POST['JudgmentMast']['appellant_name'];
            $model->respondant_name       = $_POST['JudgmentMast']['respondant_name'];
            $model->appellant_adv         = $_POST['JudgmentMast']['appellant_adv'];
            $model->respondant_adv        = $_POST['JudgmentMast']['respondant_adv'];                    
            $model->citation              = $_POST['JudgmentMast']['citation'];
            $model->judges_name           = $_POST['JudgmentMast']['judges_name'];
            $year                         = $_POST['JudgmentMast']['jyear'];
            $model->jcount = 1;
			$check = JudgmentMast::find()->select('jcount,jyear')->where(['!=','jcount','completed'])->andWhere(['jyear'=>$year])->one();
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
            	return $this->redirect(['judgment-advocate/create', 'jcount' => 3,'jyear'=>$year,'jcode'=>$judgment_code]);					
			}
			elseif($count==3) {
			 	Yii::$app->session->setFlash('Please Complete All Pages');
            	return $this->redirect(['judgment-citation/create', 'jcount' => 4,'jyear'=>$year,'jcode'=>$judgment_code]);					
			}		
			elseif($count==3) {
			 	Yii::$app->session->setFlash('Please Complete All Pages');
            	return $this->redirect(['judgment-ext-remark/create', 'jcount' => 5,'jyear'=>$year,'jcode'=>$judgment_code]);					
			}		
			elseif($count==4) {
			 	Yii::$app->session->setFlash('Please Complete All Pages');
            	return $this->redirect(['judgment-judge/create', 'jcount' => 6,'jyear'=>$year,'jcode'=>$judgment_code]);					
			}		
			elseif($count==5) {
			 	Yii::$app->session->setFlash('Please Complete All Pages');
            	return $this->redirect(['judgment-parties/create', 'jcount' => 7,'jyear'=>$year,'jcode'=>$judgment_code]);					
				}										
			}
            $model->save();
          	$judgment_code = $model->judgment_code;  
            Yii::$app->session->setFlash('Created successfully!!');
            return $this->redirect(['judgment-act/create', 'jcount' => 1,'jyear'=>$year,'jcode'=>$judgment_code]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionJudgment()
    {
    
            return $this->render('judgment');
    }
    public function actionJudgmenmast()
    {
      $judgmentmast = new JudgmentMast();
         $cache                 = Yii::$app->cache;
         $courtMast             = ArrayHelper::map(CourtMast::find()->all(), 'court_code', 'court_name');
         $jcatg_description     = ArrayHelper::map(JcatgMast::find()->all(), 'jcatg_id', 'jcatg_description');
         $jsub_catg_description = ArrayHelper::map(JsubCatgMast::find()->all(), 'jsub_catg_id', 'jsub_catg_description');
         $cache->set('courtMast', $courtMast);
         $cache->set('jcatg_description', $jsub_catg_description);
         $cache->set('jsub_catg_description', $jsub_catg_description);
         
        if($judgmentmast->load(Yii::$app->request->post()) ) {
            $model->court_name                 =  $model->courtCode->court_name;
            $model->jcatg_description          =  $model->jcatg->jcatg_description;
            $model->jsub_catg_description      =  $model->jsubCatg->jsub_catg_description;
            $model->bench_type_text            =  $model->judgmentBenchType->bench_type_text;
            $model->disposition_text           =  $model->judgmentDisposition->disposition_text;
            $model->judgment_jurisdiction_text =  $model->judgmentJurisdiction->judgment_jurisdiction_text;
            $model->appeal_numb                = $_POST['JudgmentMast']['appeal_numb'];
            $model->appellant_name             = $_POST['JudgmentMast']['appellant_name'];
            $model->respondant_name            = $_POST['JudgmentMast']['respondant_name'];
            $model->appellant_adv              = $_POST['JudgmentMast']['appellant_adv'];
            $model->respondant_adv             = $_POST['JudgmentMast']['respondant_adv'];                    
            $model->citation                   = $_POST['JudgmentMast']['citation'];
            $model->judges_name                = $_POST['JudgmentMast']['judges_name'];
            $year                              = $_POST['JudgmentMast']['jyear'];
            Yii::$app->session->setFlash('Created successfully!!');
            $judgmentmast->save(false);
            return $this->redirect(['/judgment-mast/judgment', 'status' => 'acts']);
        } else {
            return $this->render('/judgment-mast/judgment');
        }
    }
    public function actionJudgmentact()
    {

    }
    public function actionJudgmentadvocate()
    {
    
  
    }
        public function actionJudgmentcitation()
    {
    return $this->render('judgment');
    }
        public function actionJudgmentextremark()
    {

    }

        public function actionJudgmentparties()
    {
    $judgmentAct       = new JudgmentAct();
    $judgmentAdvocate  = new JudgmentAdvocate();
    $judgmentCitation  = new JudgmentCitation();
    $judgmentExtRemark = new JudgmentExtRemark();
    $judgmentJudge     = new JudgmentJudge();
    $judgmentParties   = new JudgmentParties();
    return $this->render('judgment');
    }



    public function actionJudgmentjudge()
    {

        $model = new JudgmentJudge();

        if ($model->load(Yii::$app->request->post())) {
             echo "test";
        exit();
        
            return $this->redirect(['judgment', 'status' => 7]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    
    


    /**
     * Updates an existing JudgmentMast model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    
    /* public function actionMemcacheOverruled()
    {
      $cache = Yii::$app->cache;
     $courtMast = ArrayHelper::map(CourtMast::find()->all(), 'court_code', 'court_name');
     $jcatg_description = ArrayHelper::map(JcatgMast::find()->all(), 'jcatg_id', 'jcatg_description');
     $jsub_catg_description = ArrayHelper::map(JsubCatgMast::find()->all(), 'jsub_catg_id', 'jsub_catg_description');
         $cache->set('courtMast', $courtMast);
         $cache->set('jcatg_description', $jsub_catg_description);
         $cache->set('jsub_catg_description', $jsub_catg_description);*/

      //$judgmentOverruled = ArrayHelper::map(JudgmentMast::find()->select('judgment_code,judgment_title')->all(), 'judgment_code', 'judgment_title');
/*    function($result) {
        return $result['court_name'].'::'.$result['judgment_title'];
    });*/
 
     // $data = $cache->set('judgerule', $courtMast);
      /*if($data){
        print_r($cache->get('judgmentOverruled'));
          }*/
 /*if($data)
 {
    print_r($cache->get('judgerule'));
 }*/
/*    if(\Yii::$app->cache->set('judgmentOverruled',  $judgmentOverruled)){
        echo "memcached created successfully";
    } 
    else{
        echo "Error";
    }*/
   /* }*/
    public function actionUpdate($code)
    {
    	ini_set('memory_limit', '-1');
        $model = $this->findModel($code);


        if ($model->load(Yii::$app->request->post())) {
            $model->court_name                 =  $model->courtCode->court_name;
            $model->jcatg_description          =  $model->jcatg->jcatg_description;
            $model->jsub_catg_description      =  $model->jsubCatg->jsub_catg_description;
            $model->bench_type_text            =  $model->judgmentBenchType->bench_type_text;
            $model->disposition_text           =  $model->judgmentDisposition->disposition_text;
            $model->judgmnent_jurisdiction_text  =  $model->judgmentJurisdiction->judgment_jurisdiction_text;
            $model->appeal_numb                = $_POST['JudgmentMast']['appeal_numb'];
            $model->appellant_name             = $_POST['JudgmentMast']['appellant_name'];
            $model->respondant_name            = $_POST['JudgmentMast']['respondant_name'];
            $model->appellant_adv              = $_POST['JudgmentMast']['appellant_adv'];
            $model->respondant_adv             = $_POST['JudgmentMast']['respondant_adv'];                    
            $model->citation                   = $_POST['JudgmentMast']['citation'];
            $model->judges_name                = $_POST['JudgmentMast']['judges_name'];
            $year                              = $_POST['JudgmentMast']['jyear'];
            //Yii::$app->session->setFlash('Created successfully!!');
            //$judgmentmast->save(false);    
            $model->save(false);
            Yii::$app->session->setFlash('Updated successfully!!');
            return $this->redirect(['judgmentupdate', 'code' => $model->judgment_code]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionJudgmentupdate($code='')
    {
        
            return $this->render('judgmentupdate');
    }
    public function actionMemcacheRetrive()
    {
      $cache = Yii::$app->cache;
       echo $cache->get('test'); 
/*    $return  = \Yii::$app->cache->get('judgmentOverruled'); 
    print_r($return);
    exit();*/
    }

    /**
     * Deletes an existing JudgmentMast model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($code)
    {
    $master = $this->findModel($code);
    //    	$user = $this->findModel($id);        
    $JudgmentAct         = $master->judgmentActs;
    $JudgmentAdvocate    = $master->judgmentAdvocates;
    $JudgmentCitation    = $master->judgmentCitations;
    $JudgmentExtRemark   = $master->judgmentExtRemark;
    $JudgmentJudge       = $master->judgmentJudges;
    $JudgmentParties     = $master->judgmentParties;
    $judgmentOverrules   = $master->judgmentOverrules;
    $judgmentOverruledby = $master->judgmentOverruledby;
    $judgmentRef         = $master->judgmentRefs;
    $judgmentCitedby     = $master->judgmentCitedby;


	if(!empty($JudgmentAct)){ foreach($JudgmentAct as $act) { $act->delete(); } }
	if(!empty($JudgmentAdvocate)){ foreach($JudgmentAdvocate as $Advocate) { $Advocate->delete(); } }
	if(!empty($JudgmentCitation)){ foreach($JudgmentCitation as $Citation) { $Citation->delete(); }   }	
	if(!empty($JudgmentExtRemark)){ $JudgmentExtRemark->delete();  }
	if(!empty($JudgmentJudge)){  foreach($JudgmentJudge as $Judge) { $Judge->delete(); } }
    if(!empty($JudgmentParties)){ foreach($JudgmentParties as $Parties) { $Parties->delete(); }  }
    if(!empty($judgmentOverrules)){ foreach($judgmentOverrules as $Overrules) { $Overrules->delete(); }  }
    if(!empty($judgmentOverruledby)){ foreach($judgmentOverruledby as $Overruledby) { $Overruledby->delete(); }  }
    if(!empty($judgmentRef)){ foreach($judgmentRef as $jRef) { $jRef->delete(); }  }
	if(!empty($judgmentCitedby)){ foreach($judgmentCitedby as $Citedby) { $Citedby->delete(); }  }
	$master->delete();	
       Yii::$app->session->setFlash('Deleted successfully!!');     
        return $this->redirect(['index']);
    }
  
    public function actionCourt($id)
    {
    
     $court = CourtMast::find()->where(['court_code'=>$id])->one();
     //$court['countr'] = $country;
     $country_code = $court->country_code;
     $state        =  $court->state_code;

     $state = CityMast::find()->select("city_name,city_code")->where(['country_code'=>$country_code])
//     ->andWhere('!=','country_code','1')
     ->andwhere(['state_code'=>$state])
     ->asArray()->all();     
    $result = Json::encode($state);
     return $result;          
    }
    public function actionJsubcateg($id)
    {
    
     $jsubCatg = JsubCatgMast::find()->select("jsub_catg_id,jsub_catg_description")->where(['jcatg_id'=>$id])->asArray()->all();     
    $result = Json::encode($jsubCatg);
     return $result;          
    }


    /**
     * Finds the JudgmentMast model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return JudgmentMast the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = JudgmentMast::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

<?php

namespace frontend\controllers;
use frontend\models\AdvSearch;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\rbac\DbManager;
use common\models\LoginForm;
use common\models\JudgmentMastSphinxSearch;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ChangePasswordForm;
use frontend\models\ResetPasswordForm;
use frontend\models\JudgmentComments;
use frontend\models\JudgmentCommentsSearch;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use frontend\models\PlanMaster;
use frontend\models\PlanMasterNew;
use frontend\models\PlanMast;
use frontend\models\BrowsingLog;
use frontend\models\JudgmentActCount;
use frontend\models\UserLog;
use backend\models\CountryMast;
use backend\models\StateMast;
use backend\models\CityMast;
use backend\models\JudgmentMast;
use backend\models\BareactCatgMast;
use backend\models\BareactSubcatgMast;
use backend\models\BareactMast;
use backend\models\BareactDetl;
use app\models\JudgeCourtCount;
use app\models\JudgeCourtCountNew;
use app\models\UserPlan;
use app\models\UserPlanNew;
use app\models\UserMast;
use frontend\models\JudgmentCount;
use yii\data\Pagination;
use yii\helpers\Json;
use kartik\mpdf\Pdf;
use mPDF;


/***** Comments Category
Old judgment page redirected from old sidebar
Plan Subscription start
Old sidebar start
Dynamic Dependent Dropdown code start
Predefined/inbuilt features start
Manticore function start (2)
Abstract Suggestion start
Submenus in header start
Start of Bareact Sidebar

*****/


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
  
     /*====== Old judgment page redirected from old sidebar =====*/
     public function actionJudgmentdetail()
     {

        $judgment_code = $_GET['judgment_code'];  
        //$this->layout = 'InnerPage';
        $model = JudgmentMast::findOne($judgment_code);
        $username = \Yii::$app->user->identity->username;
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();
        return $this->render('judgmentdetail', [
        'model' => $model,
      ]);
   
    }
    /*====== end of old judgment page redirected from old sidebar =======*/

    /*======= Plan Subscription start =======*/
    public function actionPlanform()
    {
        //$this->layout = 'InnerPage';
        //$userplan = new \app\models\UserPlan();
        $username = \Yii::$app->user->identity->username;
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("SELECT plan,expiry_date from user_plan where username= :username and expiry_date >= NOW()", [':username' => $username ]);

        $sel_plan = $command->queryAll();
       if($sel_plan){
        return $this->render('planview', [
            'model' => $sel_plan,
            ]);
        }
        $model = new \app\models\PlanMaster();
        //$authItems = $model->find()->where(['plan_type' => 'I'])->all();
        $fullaccess = $model->find()->where(['plan' => 'Full access'])->all();
        $corpaccess = $model->find()->where(['plan' => 'Corporate full access'])->all();
       if($_POST){
         //  print_r($_POST);exit;
        if(!empty($_POST['plan'])){
    
        if(is_array($_POST['plan'])){

        foreach($_POST['plan'] as $key => $value){
           // echo $value." ".$key."</br>";
           if(isset( $_POST['duration'])){
           $duration = $_POST['duration'];
           
           $expiry_date = date('Y-m-d', strtotime("+$duration month"));
           $username = \Yii::$app->user->identity->username;
           
           $userplan = new \app\models\UserPlan();
           $userplan->username= $username;   
           $userplan->plan= $value; 
           $userplan->tenure= $duration; 
           $userplan->start_date= date('Y-m-d');  
           $userplan->expiry_date= $expiry_date ; 

           if(isset($_POST['ip'])){
                $ip = $_POST['ip'];
                $userplan->corporate_ip= $ip ; 
           }
           $userplan->validate();
         
           $exists = UserPlan::find()->where( [ 'username' => $username,'plan' => $value ] )->exists();

            if($exists) {
                //it exists
                //echo "Plan already exists";
                \Yii::$app->db->createCommand("UPDATE user_plan SET tenure=:tenure, expiry_date=:expiry_date WHERE username=:username and plan=:plan")
                    ->bindValue(':username', $username)
                    ->bindValue(':plan', $value)
                    ->bindValue(':tenure', $duration)
                    ->bindValue(':expiry_date', $expiry_date)
                    ->execute();
            } else {
                  //doesn't exist so create record
                   $userplan->save(false); 
            }
            Yii::$app->session->setFlash('success', "User Plan updated.");
           }
        }
        } 
        }
         //exit;
        }
     
        return $this->render('planform', [
         'model' => $model,
         //'authItems' => $authItems,
         'fullaccess' => $fullaccess,
         'corpaccess' => $corpaccess,
        ]);
    }


    public function actionPlanformnew()
    {
        //$this->layout = 'InnerPage';
         //$this->layout = 'sidebar';
        //$userplan = new \app\models\UserPlan();
      $this->layout = 'mainstep2';
        
        $username = \Yii::$app->user->identity->username;
        $id = Yii::$app->user->identity->id;
        $connection = Yii::$app->getDb();
        $user = new LoginForm();
        $command = $connection->createCommand("SELECT court_name,expiry_date from user_plan_new where username= :username and expiry_date >= NOW()", [':username' => $username ]);

        $sel_plan = $command->queryAll();
       //  echo "<pre>";print_r($sel_plan) ; exit;       
        if($sel_plan){
        return $this->render('planviewnew', [
            'model' => $sel_plan,
            ]);
        }
        $model = new \app\models\PlanMasterNew();
       
       // $authItems = $model->find()->asArray()->where(['plan_type' => 'I'])->all();
        $fullaccess = $model->find()->where(['court_name' => 'Full access'])->all();
        $corpaccess = $model->find()->where(['court_name' => 'Corporate full access'])->all();
       if($_POST){
         //  print_r($_POST);exit;
        if(!empty($_POST['court_name'])){
    
        if(is_array($_POST['court_name'])){

        foreach($_POST['court_name'] as $key => $value){
           // echo $value." ".$key."</br>";
           if(isset( $_POST['duration'])){
           $duration = $_POST['duration'];
            $payment_amount = $_POST['ftotal'];
           
           $expiry_date = date('Y-m-d', strtotime("+$duration month"));
           $username = \Yii::$app->user->identity->username;
           
           $userplan = new \app\models\UserPlanNew();
           $userplan->username= $username;
           $value_brk = explode('-', $value);
           $c_name = array_shift($value_brk);
           $c_code = array_pop($value_brk);  
           $userplan->court_name= $c_name; 
           $userplan->court_code= $c_code; 
           $userplan->tenure= $duration; 
           $userplan->payment_amount = $payment_amount;
           $userplan->apply_date= date('Y-m-d');  
           $userplan->expiry_date= $expiry_date ; 
          


           if(isset($_POST['corporate_ip'])){
                $ip = $_POST['corporate_ip'];
                $userplan->corporate_ip= $ip ; 
           }
           $userplan->validate();
           if ($userplan->save() && $user->SetStatus($id,'3')) {
                $msg = "User profile updated.";
                  Yii::$app->session->setFlash('success', "Plan Seleceted ."); 
                 return $this->redirect(['dashboard']);

              } else {
                  Yii::$app->session->setFlash('error', "Plan not Seleceted .");
              }
         
           $exists = UserPlanNew::find()->where( [ 'username' => $username,'court_name' => $value ] )->exists();

            if($exists) {
                //it exists
                //echo "Plan already exists";
                \Yii::$app->db->createCommand("UPDATE user_plan_new SET tenure=:tenure, expiry_date=:expiry_date WHERE username=:username and court_name=:court_name")
                    ->bindValue(':username', $username)
                    ->bindValue(':court_name', $value)
                    ->bindValue(':tenure', $duration)
                    ->bindValue(':expiry_date', $expiry_date)
                    ->execute();
            } else {
                  //doesn't exist so create record
                   $userplan->save(false); 
            }
            Yii::$app->session->setFlash('success', "User Plan updated.");
           }
        }
        } 
        }
         //exit;
        }
     
        return $this->render('planformnew', [
         'model' => $model,
         //'authItems' => $authItems,
         'fullaccess' => $fullaccess,
         'corpaccess' => $corpaccess,
        ]);
    }
   

   public function actionPlanformms()
    {
      $model = PlanMast::find()->all();

      return $this->render('planformms_test',[
       'model' => $model,
      ]);

    }
    

    public function actionEditplan()
    {
        //$this->layout = 'InnerPage';
        //$userplan = new \app\models\UserPlan();
        $username = \Yii::$app->user->identity->username;
      
        $model = new \app\models\PlanMaster();
        $authItems = $model->find()->where(['plan_type' => 'I'])->all();
        $fullaccess = $model->find()->where(['plan' => 'Full access'])->all();
        $corpaccess = $model->find()->where(['plan' => 'Corporate full access'])->all();
       if($_POST){
         //  print_r($_POST);exit;
        if(!empty($_POST['plan'])){
    
        if(is_array($_POST['plan'])){

        foreach($_POST['plan'] as $key => $value){
           // echo $value." ".$key."</br>";
           if(isset( $_POST['duration'])){
           $duration = $_POST['duration'];
           
           $expiry_date = date('Y-m-d', strtotime("+$duration month"));
           $username = \Yii::$app->user->identity->username;
           
           $userplan = new \app\models\UserPlan();
           $userplan->username= $username;   
           $userplan->plan= $value; 
           $userplan->tenure= $duration; 
           $userplan->start_date= date('Y-m-d');  
           $userplan->expiry_date= $expiry_date ; 

           if(isset($_POST['ip'])){
                $ip = $_POST['ip'];
                $userplan->corporate_ip= $ip ; 
           }
           $userplan->validate();
         
           $exists = UserPlan::find()->where( [ 'username' => $username,'plan' => $value ] )->exists();

            if($exists) {
                //it exists
                //echo "Plan already exists";
                \Yii::$app->db->createCommand("UPDATE user_plan SET tenure=:tenure, expiry_date=:expiry_date WHERE username=:username and plan=:plan")
                    ->bindValue(':username', $username)
                    ->bindValue(':plan', $value)
                    ->bindValue(':tenure', $duration)
                    ->bindValue(':expiry_date', $expiry_date)
                    ->execute();
            } else {
                  //doesn't exist so create record
                   $userplan->save(false); 
            }

           
            Yii::$app->session->setFlash('success', "User Plan updated.");
           }
        }
        } 
        }
         //exit;
        }
     
        return $this->render('planform', [
         'model' => $model,
         'authItems' => $authItems,
         'fullaccess' => $fullaccess,
         'corpaccess' => $corpaccess,
        ]);
    }

    public function actionEditplannew()
    {
        //$this->layout = 'InnerPage';
        //$userplan = new \app\models\UserPlan();
        $username = \Yii::$app->user->identity->username;
      
        $model = new \app\models\PlanMasterNew();
        $authItems = $model->find()->where(['plan_type' => 'I'])->all();
        $fullaccess = $model->find()->where(['court_name' => 'Full access'])->all();
        $corpaccess = $model->find()->where(['court_name' => 'Corporate full access'])->all();
       if($_POST){
         //  print_r($_POST);exit;
        if(!empty($_POST['court_name'])){
    
        if(is_array($_POST['court_name'])){

        foreach($_POST['court_name'] as $key => $value){
           // echo $value." ".$key."</br>";
           if(isset( $_POST['duration'])){
           $duration = $_POST['duration'];
           $payment_amount = $_POST['ftotal'];
           
           $expiry_date = date('Y-m-d', strtotime("+$duration month"));
           $username = \Yii::$app->user->identity->username;
           
           $userplan = new \app\models\UserPlanNew();
           $userplan->username= $username;
           $value_brk = explode('-', $value);
           $c_name = array_shift($value_brk);
           $c_code = array_pop($value_brk);  
           $userplan->court_name= $c_name; 
           $userplan->court_code= $c_code;    
           $userplan->tenure= $duration;
           $userplan->payment_amount = $payment_amount; 
           $userplan->apply_date= date('Y-m-d');  
           $userplan->expiry_date= $expiry_date ; 

           if(isset($_POST['corporate_ip'])){
                $ip = $_POST['corporate_ip'];
                $userplan->corporate_ip= $ip ; 
           }
           $userplan->validate();
         
           $exists = UserPlanNew::find()->where( [ 'username' => $username,'court_name' => $value ] )->exists();

            if($exists) {
                //it exists
                //echo "Plan already exists";
                \Yii::$app->db->createCommand("UPDATE user_plan_new SET tenure=:tenure, expiry_date=:expiry_date WHERE username=:username and court_name=:court_name")
                    ->bindValue(':username', $username)
                    ->bindValue(':court_name', $value)
                    ->bindValue(':tenure', $duration)
                    ->bindValue(':expiry_date', $expiry_date)
                    ->execute();
            } else {
                  //doesn't exist so create record
                   $userplan->save(false); 
            }

           
            Yii::$app->session->setFlash('success', "User Plan updated.");
           }
        }
        } 
        }
         //exit;
        }
     
        return $this->render('planformnew', [
         'model' => $model,
         'authItems' => $authItems,
         'fullaccess' => $fullaccess,
         'corpaccess' => $corpaccess,
        ]);
    }

     /*===== Plan Subscription end =======*/

          public function actionJudgmentpdf($id)
    { 
        
        $sql = (new \yii\db\Query());
        $sql->select(['court_name','judgment_date','judgment_title','appellant_name','respondant_name','judges_name','judgment_abstract','judgment_text']) 
           ->from('judgment_mast')
           ->where('judgment_code=:judgment_code', [':judgment_code' => $id]);
        $command = $sql->createCommand();
        $data = $command->queryAll(); 
        
         $content = $this->renderPartial('_reportView', [
            'model' => $data,
            
        ]);
         // setup kartik\mpdf\Pdf component
    $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_CORE, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
        // any css to be embedded if required
        'cssInline' => '.kv-heading-1{font-size:15px}', 
         // set mPDF properties on the fly
        'options' => [
            'title' => 'Court Judgement',
             'showWatermarkText' => true, 
        ],
         // call mPDF methods on the fly
        'methods' => [ 
            'SetWatermarkText' => 'courtsjudgments.com',
            'SetHeader'=>['Courts Judgments'], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
    
    // return the pdf output as per the destination setting
    return $pdf->render(); 


    }

    //this function is created for adding judgment in user account from ajax request
    public function actionAddtomyaccount($jcode,$uri)
    {

        $username = \Yii::$app->user->identity->username; 
        $jmast = JudgmentMast::find()->select(['judgment_title','doc_id','court_code'])->where(['judgment_code'=>$jcode])->all();
        $jtitle = $jmast[0]['judgment_title'];
        $jdocid = $jmast[0]['doc_id'];
        $jcourt = $jmast[0]['court_code'];
        $jdate = date('Y-m-d');
        $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
         $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;
        
        $model = new UserLog();
        $model->username = $username;
        $model->doc_id = $jdocid;
        $model->judgment_code = $jcode;
        $model->judgment_title = $jtitle;
        $model->court_code = $jcourt;
        $model->save_date = $jdate;
        $model->link = $url;
        $model->save();
        
        $result = Json::encode($jmast);
        return $result;
    }

    //this function is created for display judgment saved in user account 
    public function actionMyAccount()
    {
         $username = \Yii::$app->user->identity->username;
         //$model = UserLog::find()->where(['username'=>$username])->all();
         $models = (new \yii\db\Query())
            ->select('judgment_code,judgment_title,court_code,save_date,link')
            ->from('user_log')
            ->where(['username'=>$username])
            ->orderBy(['save_date'=> SORT_DESC]);
            
        $countQuery = clone $models;
             $pages = new Pagination(['totalCount' => $countQuery->count()]);
            $models = $models->offset($pages->offset)
                ->limit($pages->limit)
                ->all();
        return $this->render('myaccount', [
            'models' => $models,
            'pages' => $pages,
         ]);
    }
  

    
       /*===== Old sidebar start ======*/
    // To get the Year wise judgement list
     public function actionJlist()
     {
           //$this->layout = 'sidebar';
           $court_name = urldecode($_GET['court_name']); 
           $userplan = new \app\models\UserPlan();
           $username = \Yii::$app->user->identity->username;

            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();

           $JudgeCourtCount = new \app\models\JudgeCourtCount();
           $courtCode = $JudgeCourtCount->getCourtCode($court_name);
           //echo $courtCode->court_code;
           //exit;
           $expDate = $userplan->getPermissions($court_name,$username);
           if($expDate){
           //echo "testing"; exit;
           $model = new JudgmentMast();
           $Jmast = $model->getJudgmentByYear($courtCode);
             //echo "<pre>"; print_r($Jmast);
             // exit; 
           return $this->render('jyearlist', [
              'jmast' => $Jmast,
           ]);
           } else {
              
               Yii::$app->session->setFlash('error', 'You are not authorize to access this page, please upgrade your plan to view the judgement list!');
                return $this->render('message');
        }
    }

    public function actionJlistnew()
     {
           //$this->layout = 'sidebar';
           $court_name = urldecode($_GET['court_code']); 
           $userplan = new \app\models\UserPlanNew();
           $username = \Yii::$app->user->identity->username;
           
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();


           $JudgeCourtCount = new \app\models\JudgeCourtCountNew();
           $courtCode = $JudgeCourtCount->getCourtCode($court_name);
           
           //echo $courtCode->court_code;
           //exit;
           $expDate = $userplan->getPermissions($court_name,$username);
           if($expDate){
           //echo "testing"; exit;
           $model = new JudgmentMast();
           $Jmast = $model->getJudgmentByYear($courtCode);
             //echo "<pre>"; print_r($Jmast);
             // exit; 
           return $this->render('jyearlist', [
              'jmast' => $Jmast,
           ]);
           } else {
              
               Yii::$app->session->setFlash('error', 'You are not authorize to access this page, please upgrade your plan to view the judgement list!');
                return $this->render('message');
        }
    }

    

    // To get the Year wise judgement list
     public function actionJudgmentlist()
     {

        $jyear = $_GET['jyear'];  
        $court_code = $_GET['court_code'];       
        //$this->layout = 'sidebar';
        $model = new JudgmentMast();
        $username = \Yii::$app->user->identity->username;
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();

        $Jmast = $model->getJudgmentList($court_code,$jyear);
        //echo "<pre>"; print_r($Jmast);
        // exit; 
        return $this->render('judgmentlist', [
        'jmast' => $Jmast,
      ]);
   
    }
    /*====== Old sidebar end =======*/

    /*======= Dynamic Dependent Dropdown code start =======*/
    public function actionSubcat() {
    $out = [];
    $statemodel = new StateMast();
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];
        if ($parents != null) {
            $cat_id = $parents[0];
            $out =  $statemodel->getSubCatList($cat_id); 
                   return \yii\helpers\Json::encode(['output'=>$out, 'selected'=>'']);
        }
    }

    echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);

}


 // To get the city Id and name

    public function actionGetcity() {
    $out = [];
    $model = new CityMast();
    if (isset($_POST['depdrop_parents'])) {
        $parents = $_POST['depdrop_parents'];

        if ($parents != null) {

            $cat_id = $parents[0];

            $out =  $model->getCityList($cat_id); 
                   return \yii\helpers\Json::encode(['output'=>$out, 'selected'=>'']);
        }

    }

    echo \yii\helpers\Json::encode(['output'=>'', 'selected'=>'']);

}

/*===== Dynamic Dependent Dropdown code end =======*/
    public function behaviors()
    {
        return [
          'access' => [
                'class' => AccessControl::className(),
                'only' => ['step2','logout','dashboard','change-password'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                   
                ],
            ],
           
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'test1' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    /*public function actionDynamiccities()
    {
        $data=Location::model()->findAll('parent_id=:parent_id', 
        array(':parent_id'=>(int) $_POST['country_id']));
        $data=CHtml::listData($data,'id','name');
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',
                array('value'=>$value),CHtml::encode($name),true);
        }
    }
*//*no use*/

    /*====== Predefined/inbuilt features start =======*/

   public function actionIndex()
    {
        $this->layout = 'landing';
         $model = new SignupForm();
        $usermodel = new UserMast();
        $judgment_count = JudgmentCount::find()->one();
        if ($model->load(Yii::$app->request->post())) {
                //$username      = $_POST['SignupForm']['first_name'];
                $email         = $_POST['SignupForm']['email'];
                $mobile_number = $_POST['SignupForm']['mobile_number'];
            if ($user = $model->signup()) {
                    $id                   = $user->id;
                    $usermodel->id    = $id;
                    //$usermodel->username  = $username;
                    $usermodel->email     = $email;
                    $usermodel->mobile_1  = $mobile_number;
                    $usermodel->sign_date = date('Y-m-d h:i:s');
                    $usermodel->status    = 0;
                    $usermodel->save(false);
                    //$username = 'User';
                    //$this->sendEmail($email);
                    return $this->render('signupsuccess');
            }
        }
        return $this->render('index', [
            'model' => $model,
            'judgment_count' => $judgment_count,
        ]);
        //return $this->render('index');
    }





    /**
     * Logs in a user.

    *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['site/dashboard']);
        }
       
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
             $usermodel = new UserMast();
                
             $userdata = UserMast::find()->where(['id'=>Yii::$app->user->id])->one();
             if($userdata->status == '1')
             {
               return $this->redirect(['site/step2']);

             } else if($userdata->status == '2'){
              return $this->redirect(['planformnew']);
            }
            else if($userdata->status == '3'){
             $user_email = $userdata->email;
             $user_exp = UserPlanNew::find()->where(['username'=>$user_email])->one();
             $user_expiry = $user_exp->expiry_date; 
             $current_date = date('Y-m-d');
             if($current_date == $user_expiry || $current_date > $user_expiry){
              Yii::$app->user->logout();
              return $this->redirect(['site/account-expiry']);
             }else {  

               return $this->redirect(['site/dashboard']);
             }
             return $this->redirect(['site/dashboard']);
             } else if($userdata->status == '0'){

                     Yii::$app->user->logout();
                   return $this->render('signuperror'); 
             }
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionAccountExpiry(){
      return $this->render('account_expiry'); 
    }

  /*  //session

    public function actionUserSessionUpdate() {
    $session = Yii::$app->session;
    $userid = $session->get('userid');
    $username = $session->get('username');
    $data = array('session_id' => Yii::$app->session->getId());
    $isUserLogin = (!empty($userid) && !empty($username)) ? 'true' : 'false';
    if ($isUserLogin == 'false') {
        echo 'gotologin'; exit;
        //return $this->redirect(['/login']);
    } else {
        //Login user
       
        $active_sess = UserMast::findOne($userid);
        $loginjson = json_decode($active_sess->conc_login);
       
        $login_json = [];
        foreach ($loginjson as $key => $val) {
            if ($val->session_key == Yii::$app->session->getId()) {
                $login_json[] = [$val->session_key => $val->session_key, 'session_key' => $val->session_key, 'time' => time()];
            } else {
                $login_json[] = [$val->session_key => $val->session_key, 'session_key' => $val->session_key, 'time' => $val->time];
            }
        }

        
        $login_json = json_encode($login_json);
        $active_sess->conc_login = $login_json;
        $active_sess->save();
    }
    exit;
}*/

    //pooja

    /**
     * Logs out the current user.
     *

     * @return mixed
     */
  public function actionLogout()
    {
        Yii::$app->user->logout();
         return $this->goHome();
    }



    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        //$this->layout = 'InnerPage';
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays about page.
     *

     * @return mixed
     */
    public function actionAbout()
    {
       //$this->layout = 'InnerPage';
       return $this->render('about');
    }

    public function actionSignup()
    {
        //$this->layout = 'InnerPageLayout';
        $model = new SignupForm();
        $usermodel = new UserMast();
        if ($model->load(Yii::$app->request->post())) {
                //$username      = $_POST['SignupForm']['first_name'];
                $email         = $_POST['SignupForm']['email'];
                $mobile_number = $_POST['SignupForm']['mobile_number'];
            if ($user = $model->signup()) {
                    $id                   = $user->id;
                    $usermodel->id    = $id;
                    //$usermodel->username  = $username;
                    $usermodel->email     = $email;
                    $usermodel->mobile_1  = $mobile_number;
                    $usermodel->sign_date = date('Y-m-d h:i:s');
                    $usermodel->status    = 0;
                    $usermodel->save(false);
                    //$username = 'User';
                    //$this->sendEmail($email);
                     
                   
                    return $this->render('signupsuccess'); 
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *

     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    /**
     * Resets password.
     *

     * @param string $token

     * @return mixed

     * @throws BadRequestHttpException
     */
    public function actionVerify()
    {
        $connection = \Yii::$app->db;
        $email = $_GET['user_email'];
        $user_email = base64_decode($email);
        $model = UserMast::find()->where(['email' => $user_email])->one();
       
        
        $sql = "UPDATE user_mast SET status=1 WHERE id = $model->id";
        $command = $connection->createCommand($sql);
       
        if ($command->execute()==1){
              Yii::$app->session->setFlash('success', "Thanks for email verification"); 
          } else {
                  Yii::$app->session->setFlash('error', "User not saved.");
              }

         return $this->redirect(['login']);


    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
     }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {

            Yii::$app->session->setFlash('success', 'New password saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /*===== Predefined/inbuilt features end ========*/

    
    /**
     * Displays search page.
     *

     * @return mixed
     */

     /*====Manticore function start=======*/
         public function actionHighCourt()
    {
      $models = JudgmentCourtCount::find()->select(['judgment_count','court_name'])->where(['court_type' => '2'])->orderBy('court_name')->all();
       return $this->render('high_court_list',[
         'models' => $models,
       ]);
    }

    public function actionTribunalCourt()
    {
      $models = JudgmentCourtCount::find()->select(['judgment_count','court_name'])->where(['court_type' => '3'])->orderBy('court_name')->all();
       return $this->render('tribunal_court_list',[
         'models' => $models,
       ]);
    }

    /* for testing purpose 19/06*/
    // public function actionSearchnew()
    // {
    //     if (!Yii::$app->user->isGuest){ 
    //     $username = \Yii::$app->user->identity->username;
    //     $plans = UserPlanNew::find()->where([ 'username' => $username])->all();
    //      $corporate_ip = $plans[0]->corporate_ip;
    //      $ip = $_SERVER['REMOTE_ADDR'];

    //      if($corporate_ip!='' && $corporate_ip==$ip){
    //     $params = \Yii::$app->request->get();
        
    //     $model = new JudgmentMastSphinxSearch();
    //      //$suggest=$model->keyWordSuggestion("");
    //     $data = $model->searchJudgements1($params);
    //     //print_r($data);exit;
    //     $data['term'] = isset($params['q']) ? $params['q'] : '';
    //     $data['term_previous'] = isset($params['p']) ? $params['p'] : '';
    //     $data['term_again'] = isset($params['again']) ? $params['again'] : 0;
    //     $data['advance_search'] = isset($params['advance_search']) && $params['advance_search'] == 1 ? 1 : 0;
    //     if($data['term_again']==0):
    //     $data['term_previous'] =null;
    //     endif;
    //     if(isset($data["data"]) && count($data["data"]) < 5 && isset($data['term'])):
    //        $suggest=$model->keyWordSuggestion1($data['term']);
    //        if(!empty($suggest)):
    //        //suggest keyword is not empty it has suggested  word
    //        $data["suggest"] = $suggest;
    //        endif;
    //     endif;
    //     //$this->layout = 'InnerPage';
    //     return $this->render('searchnew',$data);
    //   } if($corporate_ip!=''  && $corporate_ip!=$ip){
    //     Yii::$app->session->setFlash('error', 'You are not authorize to access this page, please login with registered Ip');
    //             return $this->render('message');

    //   }
    //     $params = \Yii::$app->request->get();
        
    //     $model = new JudgmentMastSphinxSearch();
    //     //$suggest=$model->keyWordSuggestion("");
    //     $data = $model->searchJudgements1($params);
    //     //print_r($data);exit;
    //     $data['term'] = isset($params['q']) ? $params['q'] : '';
    //     $data['term_previous'] = isset($params['p']) ? $params['p'] : '';
    //     $data['term_again'] = isset($params['again']) ? $params['again'] : 0;
    //     $data['advance_search'] = isset($params['advance_search']) && $params['advance_search'] == 1 ? 1 : 0;
    //     if($data['term_again']==0):
    //     $data['term_previous'] =null;
    //     endif;
    //     if(isset($data["data"]) && count($data["data"]) < 5 && isset($data['term'])):
    //        $suggest=$model->keyWordSuggestion1($data['term']);
    //        if(!empty($suggest)):
    //        //suggest keyword is not empty it has suggested  word
    //        $data["suggest"] = $suggest;
    //        endif;
    //     endif;
    //     //$this->layout = 'InnerPage';
    //     return $this->render('searchnew',$data);


    //      }else{
    //      Yii::$app->session->setFlash('error', 'You are not authorize to access this page, please login first to view the search result!');
    //             return $this->render('message');

    // }
    // }

//with old layout
    public function actionSearch1()
    {   
        if (!Yii::$app->user->isGuest){ 
        $params = \Yii::$app->request->get();
        $model = new JudgmentMastSphinxSearch();
        //$suggest=$model->keyWordSuggestion("");
        $data = $model->searchJudgements($params);
        $data['term'] = isset($params['q']) ? $params['q'] : '';
        $data['term_previous'] = isset($params['p']) ? $params['p'] : '';
        $data['term_again'] = isset($params['again']) ? $params['again'] : 0;
        $data['advance_search'] = isset($params['advance_search']) && $params['advance_search'] == 1 ? 1 : 0;
        if($data['term_again']==0):
        $data['term_previous'] =null;
        endif;
        if(isset($data["data"]) && count($data["data"]) < 5 && isset($data['term'])):
           $suggest=$model->keyWordSuggestion($data['term']);
           if(!empty($suggest)):
           //suggest keyword is not empty it has suggested  word
           $data["suggest"] = $suggest;
           endif;
        endif;
        $this->layout = 'InnerPage';
        return $this->render('search1',$data);
    }else{
         Yii::$app->session->setFlash('error', 'You are not authorize to access this page, please upgrade your plan to view the search result!');
                return $this->render('message');

    }
    }

   

    public function actionSearch()
    {
      
        if (!Yii::$app->user->isGuest){ 
        $username = \Yii::$app->user->identity->username;
        if(UserPlanNew::find()->where([ 'username' => $username])->exists()){

        $params = \Yii::$app->request->get();
        $model = new JudgmentMastSphinxSearch();
        //$suggest=$model->keyWordSuggestion("");
        $data = $model->searchJudgements($params);
        $data['startDate'] = isset($params['startDate']) ? $params['startDate'] : '';
        $data['endDate'] = isset($params['endDate']) ? $params['endDate'] : '';
        $data['order'] = isset($params['o']) ? $params['o'] : '';
        $data['term'] = isset($params['q']) ? $params['q'] : '';
        $data['term_previous'] = isset($params['p']) ? $params['p'] : '';
        $data['court_code'] = isset($params['court_code']) ? $params['court_code'] : '';
        $data['term_again'] = isset($params['again']) ? $params['again'] : 0;
        $data['advance_search'] = isset($params['advance_search']) && $params['advance_search'] == 1 ? 1 : 0;
        if($data['term_again']==0):
        $data['term_previous'] =null;
        endif;
        if(isset($data["data"]) && count($data["data"]) < 5 && isset($data['term'])):
           $suggest=$model->keyWordSuggestion($data['term']);
           if(!empty($suggest)):
           //suggest keyword is not empty it has suggested  word
           $data["suggest"] = $suggest;
           endif;
        endif;
        //$this->layout = 'InnerPage';
        return $this->render('search',$data);
         }else{
             Yii::$app->session->setFlash('error', 'You are not authorize to access this page, please select a plan first from <a href="/legal_mix/site/planformnew">Plan Subscription</a>');
                return $this->render('message');
         }

         }else{
         Yii::$app->session->setFlash('error', 'You are not authorize to access this page, please login first to view the search result!');
                return $this->render('message');

    }
    }

    
 
    public function actionSearchsuggestion(){
        $params = \Yii::$app->request->get();
        $keyword=isset($params['q']) ? $params['q'] : '';
        $model = new JudgmentMastSphinxSearch();
        $data = $model->SearchSuggestion($keyword);
        echo json_encode($data);die;
    }

        /* 20/10/20 */
        public function actionCustomSearch()
        {
          return $this->render('custom_search');
        }



        public function actionCustomAjaxSearch($srch,$fltr)
        {
          
          if($fltr=='1'){
            $model = JudgmentMast::find()
            ->select('judgment_code,court_name,judgment_date,judgment_title,appellant_name,respondant_name,disposition_text,citation,judges_name,judgment_abstract,judgment_text')
            ->where('judgment_title LIKE'.  "'%$srch%'")
            ->all();
            }

          if ($fltr=='2') {
          
          $model = JudgmentMast::find()
          ->select('judgment_code,court_name,judgment_date,judgment_title,appellant_name,respondant_name,disposition_text,citation,judges_name,judgment_abstract,judgment_text')
          ->where('citation LIKE '. "'%$srch%'")
        //->addParams(['citation'=>$srch])
          ->all(); 
          
          }

          
         return Json::encode($model);

        }


        public function actionSearchForm()
    {
       
       
       return $this->renderAjax('partials1/search_form');
       //return $this->renderAjax('partials1/search_form',['courtsData' => $string,]);
        
    }
    /*
    *
    */
    public function actionJudgment()
    { 
        
        $params = \Yii::$app->request->get();

        /*
         * check code prameter passed
         */
        $username = \Yii::$app->user->identity->username;
        if(!empty($params) && isset($params["id"]) && !empty($params["id"]) && intval($params['id']) > 0){
            $params["judgment_code"]=$params["id"];
            $params1["doc_id"] = $params["id"];
            $data = JudgmentMast::getSearchJudgment($params["judgment_code"]);
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();
            if(empty($data["data"] )){
                //if there is no record redirect user to on main search page
                $this->redirect('/site/search');
            }else

                    //$this->layout = 'InnerPage';

                    return $this->render('detail',$data);


        }else{
            //if code parameter not passed redirect to search page
            $this->redirect('/site/search');
        }

    }
  

    /*
     *
     */
    public function actionCitedin()
    {

        $params = \Yii::$app->request->get();

        /*
         * check code prameter passed
         */
        if(!empty($params) && isset($params["id"]) && !empty($params["id"]) && intval($params['id']) > 0){



            $data = JudgmentMast::getCitedIn($params["id"]);
            $username = \Yii::$app->user->identity->username;
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();

//print_r($data);exit;
            if(!empty($data) && count($data) > 0 ){
                //if there is no record redirect user to on main search page
                //$this->layout = 'InnerPage';

                return $this->render('citedin',array("data"=>$data));
            }else
                $this->redirect('/site/search');
        }else{
            //if code parameter not passed redirect to search page
            $this->redirect('/site/search');
        }

    }
    /*
 *
 */
    public function actionCitedby()
    {

        $params = \Yii::$app->request->get();

        /*
         * check code prameter passed
         */
        if(!empty($params) && isset($params["id"]) && !empty($params["id"]) && intval($params['id']) > 0){



            $data = JudgmentMast::getCitedBy($params["id"]);
            $username = \Yii::$app->user->identity->username;
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();
//print_r($data);exit;
            if(!empty($data) && count($data) > 0 ){
                //if there is no record redirect user to on main search page
                //$this->layout = 'InnerPage';

                return $this->render('citedby',array("data"=>$data));
            }else
                $this->redirect('/site/search');
        }else{
            //if code parameter not passed redirect to search page
            $this->redirect('/site/search');
        }




    }
    /*
*
*/


    public function actionActlist()
    {

        $params = \Yii::$app->request->get();

        /*
         * check code prameter passed
         */
        if(!empty($params) && isset($params["id"]) && !empty($params["id"]) && intval($params['id']) > 0){



            $data = JudgmentMast::getActList($params["id"]);
            $username = \Yii::$app->user->identity->username;
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();

//print_r($data);exit;
            if(!empty($data) && count($data) > 0 ){
                //if there is no record redirect user to on main search page
                
                  
                  
                return $this->render('actlist',array("data"=>$data));
            }else
                $this->redirect('/site/search');
        }else{
            //if code parameter not passed redirect to search page
            $this->redirect('/site/search');
        }



    }
    
    /**
     * 
     */
    public function actionBareact()
    {

        $params = \Yii::$app->request->get();

        /*
         * check code prameter passed
         */
        if(!empty($params) && isset($params["id"]) && !empty($params["id"]) && intval($params['id']) > 0){
            if(isset($params["code"]) && !empty($params["code"]) && intval($params["code"]) > 0){
                $code=$params["code"];
            }else{
                $code=null;
            }
            $data = JudgmentMast::getBearAct($params["id"],$code);
            $username = \Yii::$app->user->identity->username;
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();
//print_r($data);exit;
            if(!empty($data["record"]) && count($data["count"]) > 0 ){

                //$this->layout = 'InnerPage';

                return $this->render('bareact',array("data"=>$data));
            }else
                 //if there is no record redirect user to on main search page
                $this->redirect('/site/search');
        }else{
            //if code parameter not passed redirect to search page
            $this->redirect('/site/search');
        }


    }

    /*=============Manticore function end============*/

    /*=============Abstract Suggestion start============*/

    public function actionJudgmentAbstract($jcode="",$doc_id="")
    {
      $searchModel = new JudgmentCommentsSearch();
      $dataProvider = $searchModel->searchabstract(Yii::$app->request->queryParams, $jcode);

      $username = \Yii::$app->user->identity->username;
      $model = new JudgmentComments();
      if ($model->load(Yii::$app->request->post())) {
        $model->judgment_code = $jcode;
        $model->doc_id = $doc_id;
        $model->username = $username;
        $model->save();
        Yii::$app->session->setFlash('success', "Your suggestion for abstract is submitted successfully. Thank you for valuable suggestion.");
        return $this->refresh();
        
      }
       return $this->render('judgment_abstract', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
       
    }

    public function actionAbstractView(){
     $id = $_GET['id']; 
     $model = JudgmentComments::find()->where(['id'=> $id])->one();

     return $this->render('abstract_view',[
       'model' => $model,
      ]);
    }

    public function actionJudgmentsComments(){
     $searchModel = new JudgmentCommentsSearch();
     $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
     return $this->render('judgments_comments',[
       'searchModel' => $searchModel,
       'dataProvider' => $dataProvider,
      ]);
    }


   /*=============Abstract Suggestion end============*/

    /**
     * Signs user up.
     *

     * @return mixed
     */
    

    /*====== Submenus in header start =========*/
     public function actionDashboard()
     {
         $id = Yii::$app->user->identity->id;
         $model = UserMast::findOne($id);
         $username = \Yii::$app->user->identity->username;
            $user_log = new BrowsingLog();
            $uri = $_SERVER['REQUEST_URI'];// Outputs: URI(w/o http or https)
            $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $url = $protocol . $_SERVER['HTTP_HOST'] . $uri;// Outputs: Full URL
            $user_log->username = $username;
            $user_log->browse_url = $url;
            $user_log->save();
         if($model->status == '0'){
           Yii::$app->session->setFlash('error', "Please verify your email!");
             return $this->redirect(['login']);
             die();
        } else {
            return $this->render('dashboard', [
            'model' => $model,
            ]); 
        }
    
      }


          public function actionHistory()
     {
         $username = Yii::$app->user->identity->username;
         $query = BrowsingLog::find()->where(['username' => $username]);
          $countQuery = clone $query;
          $pages = new Pagination(['totalCount' => $countQuery->count()]);
          $data = $query->offset($pages->offset)
          ->limit($pages->limit)
          ->all();

           return $this->render('history', [
              'data' => $data,
              'pages' => $pages,
           ]);


        /* $model = new \frontend\models\BrowsingLog;
         $data = $model->find()->where(['username' => $username])->all();
         return $this->render('history', [
            'data' => $data,
            ]); */
     }


         public function actionDashboardnew()
     {
        $id = Yii::$app->user->identity->id;
         $model = UserMast::findOne($id);
         if($model->status == '0'){
           Yii::$app->session->setFlash('error', "Please verify your email!");
             return $this->redirect(['login']);
             die();
        } else {
            return $this->render('dashboardnew', [
            'model' => $model,
            ]); 
        }
    
      }


      public function actionChangePassword()
    {
     $id = \Yii::$app->user->id;
   try {
        $model = new ChangePasswordForm($id);
      
    } catch (InvalidParamException $e) {
        throw new BadRequestHttpException($e->getMessage());
    }
 
    if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->changePassword()) {
       
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('success', 'Password Changed!');
        return $this->goHome();

    } 
        return $this->render('changePassword', [
            'model' => $model,
        ]);
     }
      /*====== Submenus in header end ========*/

      /*====== Start of Bareact Sidebar ========*/
      public function actionBareactSubcatg()
     {
           $act_code = urldecode($_GET['act_code']); 
           $barSubCatg = new BareactSubcatgMast();
           $barsubCode = $barSubCatg->getbareactCode($act_code);
           return $this->render('bareact/bareact_sub', [
              'barsubCode' => $barsubCode,
              'act_code'=>$act_code,
           ]);
           
      }

       public function actionBareactDesc($act_sub)
     {
           //$barMast = new BareactMast();
           //$barDesc = $barMast->getbareactDesc($act_sub);
          $query = BareactMast::find()->where(['act_sub_catg_code' => $act_sub])->orderBy('bareact_desc');
          $countQuery = clone $query;
          $pages = new Pagination(['totalCount' => $countQuery->count()]);
          $barDesc = $query->offset($pages->offset)
          ->limit($pages->limit)
          ->all();

           return $this->render('bareact/bareact_desc', [
              'bardesc' => $barDesc,
              'pages' => $pages,
           ]);
           
      }

       public function actionBareactTitle($bar_code)
     {
           //$barDetl = new BareactDetl();
           //$barTitle = $barDetl->getbareactTitle($bar_code);
           $query = BareactDetl::find()->where(['bareact_code'=>$bar_code])->orderBy('sno,level');
           $countQuery = clone $query;
           $pages = new Pagination(['totalCount' => $countQuery->count(),'defaultPageSize'=>'10']);
           $barTitle = $query->offset($pages->offset)
          ->limit($pages->limit)
          ->all();
           return $this->render('bareact/bareact_title', [
              'barTitle' => $barTitle,
              'pages' => $pages,
           ]);
           
      }

       public function actionCompleteBareact($did)
     {
           
           $barDetl = new BareactDetl();
           $barBody = $barDetl->getbareactBody($did);
          
           return $this->render('bareact/complete_bareact', [
              'barBody' => $barBody,
            ]);
           
      }


      public function actionBareactFinal($id)
    {
        
         $bareact = BareactMast::find()->select(['doc_id'])->where(['bareact_code'=>$id])->one();
         $bareactmast_docid = $bareact['doc_id'];
         $query = BareactDetl::find()->select('body,doc_id')->where(['=','doc_id',$bareactmast_docid])->one();
         $result = Json::encode($query);
        
     return $result;   
    }


    



    /*======== end of Bareact Sidebar ========*/





    /*===========Manticore function start============*/
    public function actionSearchAdvance()
    {
        $params = \Yii::$app->request->get();
        $search = new AdvSearch();
        $courtsData = $search->getTreeForCourts();
//        echo '<pre>';print_r($courtsData);
//        echo json_encode($courtsData);
//        die;
//var myjson = JSON.parse('{"header":"Indian Courts","id":"1","items":{"1":{"header":"Supreme Court-India","id":"1"},"2":{"header":"High Court-India","id":"2"},"3":{"header":"Tribunal Court-India","id":"3"}}},{"header":"International Courts","id":"2","items":{"4":{"header":"Supreme Court-USA","id":"4"},"5":{"header":"Court Of Appeal-USA","id":"5"},"6":{"header":"Tribunal Courts-USA","id":"6"}}}');

       $this->view->registerJsFile("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js",['depends' => 'yii\web\JqueryAsset']);
       $this->view->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js",['depends' => 'yii\web\JqueryAsset']);
       $this->view->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js",['depends' => 'yii\web\JqueryAsset']);
       $this->view->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js",['depends' => 'yii\web\JqueryAsset']);
       
       $this->view->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css");
       $this->view->registerCssFile("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css");
       $this->view->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css");
       $string = '';
//       foreach($courtsData as $data){
//           $string = json_encode($data);
//           $string .= ',';
//       }
        foreach($courtsData as $data){
            $string .= '{header: "'.  $data['header'] . '",';
            if(is_array($data['items'])){
                $string .= 'items: [';
                foreach($data['items'] as $dt){
                    $string .= '{header: "'.  $dt['header'] . '",';

                    if(isset($dt['items']) && is_array($dt['items'])){
                        $string .= 'items: [';
                        foreach($dt['items'] as $et){
                            $string .= '{header: "'.  $et['header'] . '", id: ' . $et['id'] . '},';
                        }
                        $string .= ']';
                    }
                    $string .= '},';
                }
                $string .= ']';
            }

            // end of header string
            $string .= '},';

        }

//        echo $string;die;
//        {header: "Indian Courts", id: 1,items: {header: "Supreme Court-India", id: 1},{header: "High Court-India", id: 2},{header: "Tribunal Court-India", id: 3},]},{header: "International Courts", id: 2,items: {header: "Supreme Court-USA", id: 4},{header: "Court Of Appeal-USA", id: 5},{header: "Tribunal Courts-USA", id: 6},]},
//       $string = substr($string, 0, -1 );
//       $string = str_replace('"', "'", $string);
//       $string = str_replace("'header'", 'header', $string);
//       $string = str_replace("'id'", 'id', $string);

        return $this->render('searchAdvance',['courtsData' => $string,]);
    }

//with old layout
     public function actionSearchAdvance1()
    {
        $this->layout = 'InnerPage';
        $params = \Yii::$app->request->get();
        $search = new AdvSearch();
        $courtsData = $search->getTreeForCourts();
//        echo '<pre>';print_r($courtsData);
//        echo json_encode($courtsData);
//        die;
//var myjson = JSON.parse('{"header":"Indian Courts","id":"1","items":{"1":{"header":"Supreme Court-India","id":"1"},"2":{"header":"High Court-India","id":"2"},"3":{"header":"Tribunal Court-India","id":"3"}}},{"header":"International Courts","id":"2","items":{"4":{"header":"Supreme Court-USA","id":"4"},"5":{"header":"Court Of Appeal-USA","id":"5"},"6":{"header":"Tribunal Courts-USA","id":"6"}}}');

       $this->view->registerJsFile("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js",['depends' => 'yii\web\JqueryAsset']);
       $this->view->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/js/bootstrapValidator.min.js",['depends' => 'yii\web\JqueryAsset']);
       $this->view->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js",['depends' => 'yii\web\JqueryAsset']);
       $this->view->registerJsFile("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/js/bootstrap-datetimepicker.min.js",['depends' => 'yii\web\JqueryAsset']);
       
       $this->view->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/3.1.3/css/bootstrap-datetimepicker.min.css");
       $this->view->registerCssFile("https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css");
       $this->view->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.3/css/bootstrapValidator.min.css");
       $string = '';
//       foreach($courtsData as $data){
//           $string = json_encode($data);
//           $string .= ',';
//       }
        foreach($courtsData as $data){
            $string .= '{header: "'.  $data['header'] . '",';
            if(is_array($data['items'])){
                $string .= 'items: [';
                foreach($data['items'] as $dt){
                    $string .= '{header: "'.  $dt['header'] . '",';

                    if(isset($dt['items']) && is_array($dt['items'])){
                        $string .= 'items: [';
                        foreach($dt['items'] as $et){
                            $string .= '{header: "'.  $et['header'] . '", id: ' . $et['id'] . '},';
                        }
                        $string .= ']';
                    }
                    $string .= '},';
                }
                $string .= ']';
            }

            // end of header string
            $string .= '},';

        }

//        echo $string;die;
//        {header: "Indian Courts", id: 1,items: {header: "Supreme Court-India", id: 1},{header: "High Court-India", id: 2},{header: "Tribunal Court-India", id: 3},]},{header: "International Courts", id: 2,items: {header: "Supreme Court-USA", id: 4},{header: "Court Of Appeal-USA", id: 5},{header: "Tribunal Courts-USA", id: 6},]},
//       $string = substr($string, 0, -1 );
//       $string = str_replace('"', "'", $string);
//       $string = str_replace("'header'", 'header', $string);
//       $string = str_replace("'id'", 'id', $string);

        return $this->render('searchAdvance1',['courtsData' => $string,]);
    }

    
    public function actionSearchAdvancednew()
    {
        //$this->layout = 'InnerPage';
      if (!Yii::$app->user->isGuest){ 
        $params = \Yii::$app->request->get();
        $search = new AdvSearch();
        $courtsData = $search->getTreeForCourts();
        /*$string = '';
        foreach($courtsData as $data){
            $string .= '{header: "'.  $data['header'] . '",';
            if(is_array($data['items'])){
                $string .= 'items: [';
                foreach($data['items'] as $dt){
                    $string .= '{header: "'.  $dt['header'] . '",';

                    if(isset($dt['items']) && is_array($dt['items'])){
                        $string .= 'items: [';
                        foreach($dt['items'] as $et){
                            $string .= '{header: "'.  $et['header'] . '", id: ' . $et['id'] . '},';
                        }
                        $string .= ']';
                    }
                    $string .= '},';
                }
                $string .= ']';
            }

            // end of header string
            $string .= '},';

        }*/

       
        return $this->render('search-advancednew',['courtsData' => $courtsData,]);
        }else{
         Yii::$app->session->setFlash('error', 'You are not authorize to access this page, please login first to view this page!');
                return $this->render('message');

    }
        
   
    }

    /*===========Manticore function end============*/

public function actionStep2()
{
         $this->layout = 'mainstep2';
         $id = Yii::$app->user->identity->id;
        
         Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/images/uploads/';
         $user = new LoginForm();
         $model = UserMast::findOne($id);
         //print_r($model);die;

         $model->activation_date = date('Y-m-d h:i:s');

         //$model->exp_date = date('Y-m-d h:i:s');
         $model->user_ip = $_SERVER['REMOTE_ADDR'];
        if (Yii::$app->request->post()) {
            $model->load(\Yii::$app->request->post());
            
            $cityModel = new CityMast();
            $cityid = $model->city_code;
            $city_name =  $cityModel->getCityName($cityid);
            $model->city_name = $city_name ;

            $state = new StateMast();
            $state_name =  $state->getStateName($model->state_code);
            $model->state_name = $state_name ;

            $country = new CountryMast();
            $country_name =  $country->getCountryName($model->country_code);
            $model->country_name = $country_name ;            

            $image = UploadedFile::getInstance($model, 'user_pic');
            if($image != null){
          
            $model->user_pic = $image->name;
            $tmp = explode('.', $image->name);
           $ext = end($tmp);
            //$ext = end((explode(".", $image->name)));
            $model->imageFile = $image->name;
            $path = Yii::$app->params['uploadPath'] . $model->imageFile;
            //code to upload the user image
            if(!empty($model->imageFile)) {                
               $image->saveAs($path);
              }
             }
             $pan_no = $model->pan_no;
             $model->pan_no = strtoupper($pan_no);
             $dob = $model->dob;
             $dob = str_replace('/', '-', $dob);
           $model->dob = date('Y-m-d', strtotime($dob));
            
            
              if ($model->save() && $user->SetStatus($id,'2')) {
                $msg = "User profile updated.";
                  Yii::$app->session->setFlash('success', "User profile updated."); 
                 return $this->redirect(['planformnew']);

              } else {
                  Yii::$app->session->setFlash('error', "User not saved.");
              }
              //return $this->redirect(['index']);
         }
        return $this->render('step2', [
            'model' => $model,
        ]);

}

public function actionStep2update()
{
         $this->layout = 'mainstep2';

         $id = Yii::$app->user->identity->id;
         //Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/web/images/uploads/';
         $user = new LoginForm();
         $model = UserMast::findOne($id);
         //$model->scenario = 'update-photo-upload';
         $oldImage = $model->user_pic;
        if (Yii::$app->request->post()) {
            $model->load(\Yii::$app->request->post());
           
            $image = UploadedFile::getInstance($model, 'user_pic');
            if($image != null){
         $link = unlink(Yii::getAlias('@app').'/web/images/uploads/'. $oldImage);
           $fileName = $image->baseName.'.'.$image->extension;
            $image->saveAs(Yii::getAlias('@app').'/web/images/uploads/' . $fileName);
            $model->user_pic = $fileName;
            $model->save();
            } else {
            $model->user_pic = $oldImage;
            $model->save(false);

        }
            /*$ext = end((explode(".", $image->name)));
             $model->imageFile = $image->name;
            $path = Yii::$app->params['uploadPath'] . $model->imageFile;
            //code to upload the user image
            if ($model->imageFile && $model->validate()) {                
               $image->saveAs($path);
              }*/
             }

    
             $pan_no = $model->pan_no;
             $model->pan_no = strtoupper($pan_no);
           
        if($model->load(Yii::$app->request->post()) && $model->save()) {
          Yii::$app->session->setFlash('success', "User profile updated."); 
                 return $this->redirect(['dashboard']);
    
              } else {
                  Yii::$app->session->setFlash('error', "User not saved.");
              }
              //return $this->redirect(['index']);
        
        return $this->render('step2update', [
            'model' => $model,
        ]);
    
 }


    

     public function sendEmail($user_email="")
    {
        
        $textBody = "<html><body><p>Hello ".$user_email. "</p><br><br>
                        Thank you for showing you interested for subscription of courtsjudgments.com<br><br>
                        Please click on the link below to verify your valid email id and continue with the subscription process. <br><a href='".Yii::$app->params['domainName'].'site/verify?user_email='.base64_encode($user_email)."'>".Yii::$app->params['domainName'].'site/verify?user_email='.base64_encode($user_email)."</a>   
                        You can even copy paste the above link in the browser address bar.<br><br>
                        In case of any more issue you can forward this mail to registration@courtsjudgments.com<br><br> 
                        Thank You<br>
                        Sales Support<br>
                        courtsjudgments.com<br></body></html>";
  return   Yii::$app->mailer->compose()
    ->setTo($user_email)
    ->setFrom('admin@laxyo.org')
    ->setSubject('Email verification from courtjudgement')
    ->setHtmlBody($textBody)
    ->send();

   
    }

    public function actionUpdate()
    {
        $id = $_POST['userid'];
        $model =   UserMast::find()->where(['userid'=>$id])->one(); 
        //$this->findModel($id);
        $actual_image = $model->user_pic;
        if ($model->load(Yii::$app->request->post())) {
             try{
               $path = Yii::getAlias('@frontend') .'/web/images/profileimage/';
               $path1 = Yii::getAlias('@frontend') .'/web/images/profileimage';
               if(chmod($path1, 0545)) { chmod($path1, 0745); }  
                $user_pic = UploadedFile::getInstance($model, 'user_pic');
                if(isset($user_pic))
                {
                   $model->user_pic = date('dmyhis').str_replace(" ", "-",$user_pic->name);
          

                  $user_pic->saveAs($path.date('dmyhis').str_replace(" ", "-",$user_pic->name)); 
                }  
                else{
                      $model->user_pic = $actual_image;
                      }                
                 if($model->save(false)){
                    chmod($path1, 0545);                    
                   Yii::$app->getSession()->setFlash('success','Data saved!');  
                   return $this->redirect(['index']);
               } else {
                    chmod($path1, 0545);                
                   Yii::$app->getSession()->setFlash('error','Data not saved!');
                   return $this->render('index');
               }
              }catch(Exception $e){
                  Yii::$app->getSession()->setFlash('error',"{$e->getMessage()}");
              }
            }
         else {
            return $this->render('index');
        }
    }  


}


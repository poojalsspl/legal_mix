<?php

namespace frontend\controllers;

use Yii;
use app\models\InvcMast;
use app\models\CustMast;
use app\models\InvcMastSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\InvcDetl;
use kartik\mpdf\Pdf;
use yii\data\ActiveDataProvider;

use mPDF;

/**
 * InvcMastController implements the CRUD actions for InvcMast model.
 */
class InvcMastController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $invcTotal = 0;
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
     * Lists all InvcMast models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'InnerPage';
        $user_id = Yii::$app->user->identity->id;
        $searchModel = new InvcMastSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$user_id);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
     /**
     * Displays a invoice list for selected customer.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionList()
    {
        $custid = $_GET['custid'];
        $this->layout = 'InnerPage';
        $user_id = Yii::$app->user->identity->id;
        $model = CustMast::find()
        ->select(['custname','email','mobile1','mobile2'])
        ->where('custid = :custid', [':custid' => $custid])
        ->one();
        return $this->render('invList', 
            ['model' => $model]);
    }


    /**
     * Displays a single InvcMast model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $this->layout = 'InnerPage';
        $query = (new \yii\db\Query());
        $query->select(['invc_mast.invc_numb','invc_mast.invc_date','invc_mast.invc_amt','cust_mast.custname','cust_mast.custaddr']) 
           ->from('invc_mast')
           ->join('Inner join',
                   'cust_mast',
                   'cust_mast.custid = invc_mast.custid'
               )
             ->where('invc_mast.invc_numb=:id', [':id' => $id]);
        $command = $query->createCommand();
     
        $data = $command->queryAll();     

        $sql = (new \yii\db\Query());
        $sql->select(['invc_qty','invc_rate','invc_amt','invc_desc','disc','gst']) 
           ->from('invc_detl')
           ->where('invc_numb=:invc_numb', [':invc_numb' => $id]);
        $command1 = $sql->createCommand();
     
        $data1 = $command1->queryAll();     
      
        return $this->render('view', [
            'model' => $data[0],
            'InvcDetl' =>  $data1,
        ]);

    }

    /**
     * Creates a new InvcMast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        // $this->layout = 'CRM';
         $this->layout = 'InnerPageLayout';
        $user_id = Yii::$app->user->identity->id;
       
        $model = new InvcMast;
        $model->userid = $user_id;
        $model->invc_date = date('Y-m-d');
        $model->invc_amt = 0;
        $modelsInvoice = [new InvcDetl];
        if ($model->load(Yii::$app->request->post())) {
            $modelsInvoice = InvcMast::createMultiple(InvcDetl::classname());
            InvcMast::loadMultiple($modelsInvoice, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsInvoice),
                    ActiveForm::validate($model)
                );
            }
            //$modelsInvoice->invc_numb = $model->invc_numb;
            // validate all models
            $valid = $model->validate();
           // $valid = InvcDetl::validateMultiple($modelsInvoice) && $valid;
           // echo "<pre>";
           // print_r($modelsInvoice);
           // exit;
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsInvoice as $modelInvoice) {
                        $modelInvoice->invc_numb = $model->invc_numb;
                        $invc_amt = $modelInvoice->invc_qty *  $modelInvoice->invc_rate;
                        if($modelInvoice->disc != null){
                                $disc = $invc_amt * $modelInvoice->disc/100;
                              $invc_amt = $invc_amt - $disc;
                        }
                        if($modelInvoice->gst != null && $modelInvoice->gst != 0){
                            $gst =  $invc_amt *  $modelInvoice->gst/100;
                           $invc_amt = $invc_amt + $gst;
                        }
                         $this->invcTotal = $this->invcTotal + $invc_amt;    
                         $modelInvoice->invc_amt = $invc_amt;
                        

                        if (! ($flag = $modelInvoice->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    $model->updateTotal($modelInvoice->invc_numb,$this->invcTotal);
 
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->invc_numb]);
                    }

                  
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        return $this->render('create', [
            'model' => $model,
            'modelsInvoice' => (empty($modelsInvoice)) ? [new InvcDetl] : $modelsInvoice,
        ]);
    }

    public function actionInvpdf($id)
    {
        // $id = 1;
        $query = (new \yii\db\Query());
        $query->select(['invc_mast.invc_numb','invc_mast.invc_date','invc_mast.invc_amt','cust_mast.custname','cust_mast.custaddr']) 
           ->from('invc_mast')
           ->join('Inner join',
                   'cust_mast',
                   'cust_mast.custid = invc_mast.custid'
               )
             ->where('invc_mast.invc_numb=:id', [':id' => $id]);
        $command = $query->createCommand();
     
        $data = $command->queryAll();     

        $sql = (new \yii\db\Query());
        $sql->select(['invc_qty','invc_rate','invc_amt','invc_desc','disc','gst']) 
           ->from('invc_detl')
           ->where('invc_numb=:invc_numb', [':invc_numb' => $id]);
        $command1 = $sql->createCommand();
     
        $data1 = $command1->queryAll();  
       
   
      
       $content = $this->renderPartial('_reportView', [
            'model' => $data[0],
            'InvcDetl' =>  $data1,
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
        'options' => ['title' => 'Court Judgement Invoice'],
         // call mPDF methods on the fly
        'methods' => [ 
            'SetHeader'=>['Court Judgement'], 
            'SetFooter'=>['{PAGENO}'],
        ]
    ]);
    
    // return the pdf output as per the destination setting
    return $pdf->render(); 
       
  
    }

    /**
     * Updates an existing InvcMast model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->invc_numb]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing InvcMast model.
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
     * Finds the InvcMast model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return InvcMast the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = InvcMast::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

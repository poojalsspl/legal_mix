<?php

namespace frontend\controllers;

use Yii;
use app\models\Receipt;
use app\models\ReceiptDetail;
use app\models\ReceiptSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;

/**
 * ReceiptController implements the CRUD actions for receipt model.
 */
class ReceiptController extends Controller
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
     * Lists all receipt models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'InnerPage';
        $searchModel = new ReceiptSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single receipt model.
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
     * Creates a new receipt model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */


    public function actionCreate()
    {
        $this->layout = 'CRM';
        $custId = $_GET['custid'];
        $user_id = Yii::$app->user->identity->id;
        $model = new Receipt();
        $InvcDetl = $model->getInvcDetl($custId);
 
        if($model->load(Yii::$app->request->post())) {
        $transaction = \Yii::$app->db->beginTransaction();
            $model->userid = $user_id;
            $model->cust_id = $custId;
            $model->invoice_no = $InvcDetl[0]['invc_numb'];

        try {
               if ($flag = $model->save(false)) { 
               $count =0;
               $paidAmt = $_POST["paid_amt"];
               
               foreach ($paidAmt as $key => $value) {
                  $rdetail = new ReceiptDetail;
                  $rdetail->receipt_id = $model->id;
                  $rdetail->invoc_num = $InvcDetl[$count]['invc_numb'];
                  $rdetail->invc_amt = $InvcDetl[$count]['invc_amt'];
                  $rdetail->paid_amt = $value;
                 
                  $InvcId = $InvcDetl[$count]['Id'];
                  \Yii::$app->db->createCommand("UPDATE invc_detl SET paid_amt =:id WHERE id=:InvcId")
                    ->bindValue(':id', $value)
                    ->bindValue(':InvcId', $InvcId)
                    ->execute();
                     $count++;
                  if (! ($flag = $rdetail->save(false))) {
                                $transaction->rollBack();
                                break;
                  }
                }
            }
                if($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                }

                    
                } catch (Exception $e) {
                    $transaction->rollBack();
                }

            //return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
            'InvcDetl' =>  $InvcDetl,
          ]);
    }
     public function actionInvd(){
         $custId = $_GET['custId'];
         $receipt = new receipt();
         $InvcDetl = $receipt->getInvcDetl($custId);
         echo Json::encode($InvcDetl);
     }
    /**
     * Updates an existing receipt model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing receipt model.
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
     * Finds the receipt model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return receipt the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = receipt::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

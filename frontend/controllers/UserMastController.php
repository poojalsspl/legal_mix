<?php

namespace frontend\controllers;

use Yii;
use app\models\UserMast;
use app\models\UserMastSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserMastController implements the CRUD actions for UserMast model.
 */
class UserMastController extends Controller
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
     * Lists all UserMast models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserMastSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserMast model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    public function actionSignup()
    {
         $model = new UserMast();
        if ($model->load(Yii::$app->request->post()) ) {
            //&& $model->save()
            $user_email = $_POST['UserMast']['email'];
            $username = $_POST['UserMast']['username'];
            $this->sendMail($user_email,$username);
            return $this->redirect(['view', 'id' => $model->uid]);
        } else {
            return $this->render('signup'   , [
                'model' => $model,
            ]);
        }
    }

    /**
     * Creates a new UserMast model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserMast();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing UserMast model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->uid]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing UserMast model.
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
     * Finds the UserMast model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserMast the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserMast::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
public function sendMail($user_email="",$username="")
    {
        $textBody = "<html><body><p>Hello ".$username. "</p><br><br>
                        Thank you for showing you interested for subscription of courtsjudgments.com<br><br>
                        Please click on the link below to verify your valid email id and continue with the subscription process. <br>
                        http://domainname./KK&(UNK)&78802/%$#^??00977KH66   
                        You can even copy paste the above link in the browser address bar.<br><br>
                        In case of any more issuie you can forward this mail to registration@courtsjudgments.com<br><br> 
                        Thank You<br>
                        Sales Support<br>
                        courtsjudgments.com<br></body></html>";
                        Yii::$app->mailer->compose()
                    ->setFrom('info@courtsjudgments.com')
                    ->setTo('ashokraj18@gmail.com')
                    ->setSubject('Message subject')
                //    ->setTextBody($textBody)
                    ->setHtmlBody($textBody)
                    ->send();
/*
          $mails = Yii::$app->mailer->compose("Hello “ Name “
Thank you for showing you interested for subscription of courtsjudgments.com
Please click on the link below to verify your valid email id and continue with the subscription process. 

http://domainname./KK&(UNK)&78802/%$#^??00977KH66   

You can even copy paste the above link in the browser address bar.

In case of any more issuie you can forward this mail to registration@courtsjudgments.com 

Thank You
Sales Support
courtsjudgments.com
")
                ->setFrom('info@courtsjudgments.com')
                ->setTo($user_email)
                ->setSubject("Email Verification")
                ->send();*/
            /*             $message = '<h4>UserName : '.$user_email.'<br /></b><h4><br /> 
             <h5>Verification Link: difference.dmprojects.net/verification/verify?i='.$diff_id.'&c='.$verification_code.'<h5>';
                Yii::$app->mailer->compose('layouts/html', ['content' => $message])
                ->setFrom('info@dsignzmedia.in')
                ->setTo($user_email)
                ->setSubject("Difference Account Verification")
                ->send();*/
    }

}

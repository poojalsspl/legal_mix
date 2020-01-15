<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\models\UserMast;
use backend\models\JudgmentMast;
use yii\grid\GridView;
 

/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */
?>
  <?php $form = ActiveForm::begin(); 
    $baseUrl =   \Yii::$app->request->BaseUrl;
    //exit;
  ?>
 <h1><?= Html::encode($this->title) ?></h1>
   <div class="row" style="margin-top: 200px">
      <div class="col-lg-8">
        
 
      </div>

    <?php ActiveForm::end(); ?>
</div>
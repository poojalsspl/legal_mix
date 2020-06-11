<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\InvcMast */

//print_r($model);
//exit;
//$this->title = $model['judgment_code'];
//$this->params['breadcrumbs'][] = ['label' => 'Invc Masts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>

<div class="judgment-mast-view">
    <div class="customer-form">
    <?php $form = ActiveForm::begin(); ?>
    <?php foreach($model as $key =>$value){

    ?>
      <h2 style="text-align: center;"><?php echo $value['judgment_title'];//Html::encode($this->title) ?></h2>
    <div class="row">
      <div class="col-sm-6">
        <span><b>Court : </b></span>
        <span><?php echo $value['court_name'] ?></span>
      </div>
      <div class="col-sm-6">
        <span><b>Appellant Name : </b></span>
        <span><?php echo $value['appellant_name']; ?></span>
      </div>
    </div>
      <div class="row">
      <div class="col-sm-6">
        <span><b>Respondent Name : </b></span>
        <span><?php echo $value['respondant_name'] ?></span>
      </div>
      <div class="col-sm-6">
        <span><b>Judges Name : </b></span>
        <span><?php echo $value['judges_name']; ?></span>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
          <span><b>Abstract : </b></span>
          <span><?php echo $value['judgment_abstract']; ?></span>
      </div>
    </div>
        <div class="row">
      <div class="col-sm-12">
          <h3 style="text-align: center;"><b>Judgment</b></h3>
          <span><?php echo $value['judgment_text']; ?></span>
      </div>
    </div>
  <?php } ?>
    </div>

</div>

<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\UserMast;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */
 $form = ActiveForm::begin(); ?>
<div class="container">
  <?php
   //echo $cust_name = $model->getCustName($model->cust_id); ?>
    <?= $form->field($model, 'cust_id')->textInput(['style'=>'width:150px']) ?>
    <?= $form->field($model, 'case_charged')->textInput(['style'=>'width:150px']) ?>
    <?= $form->field($model, 'hearing_date')->textInput(['style'=>'width:150px']) ?>
    <?= $form->field($model, 'next_hearing_date')->textInput(['style'=>'width:150px']) ?>
    <?= $form->field($model, 'lawyers_name')->textInput(['style'=>'width:300px']) ?>
    <?= $form->field($model, 'judges_name')->textInput(['style'=>'width:300px']) ?>
    <?= $form->field($model, 'case_notes')->textInput(['style'=>'width:300px']) ?>
</div>
<?php ActiveForm::end(); ?>

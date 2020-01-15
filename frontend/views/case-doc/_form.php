<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\DocTypeMast;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\CaseDoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="case-doc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'userid')->textInput() ?>

    <?php // $form->field($model, 'cust_id')->textInput() ?>

    <?php // $form->field($model, 'case_id')->textInput() ?>

    <?php // $form->field($model, 'doc_type_id')->textInput() ?>

    <?php 
    echo $form->field($model, 'doc_type_id')
     ->dropDownList(
            ArrayHelper::map(DocTypeMast::find()->asArray()->all(), 'doc_type_id', 'doc_type_name',  ['prompt'=>'Select doc type'])
            )
?>
  

    <?= $form->field($model, 'doc_url')->textInput(['maxlength' => true]) ?>

    


           

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

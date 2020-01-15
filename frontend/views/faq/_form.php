<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\models\FaqCatgMast;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\Faq */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-form">

    <?php $form = ActiveForm::begin(); ?>
      <?php
    $faq = ArrayHelper::map(FaqCatgMast::find()->all(), 'faq_catg_id', 'faq_catg_desc'); 
    ?>

    
         <?= $form->field($model, 'faq_catg_id')->widget(Select2::classname(), [
          
          'data' => $faq,
          //'language' => '',
          'options' => ['placeholder' => 'Select Faq Category'],
          'pluginEvents'=>[
            ]
          ]); ?>

    <?= $form->field($model, 'faq_title')->textInput(['maxlength' => true]) ?>

    

       <?= $form->field($model, 'faq_date')->widget(DateRangePicker::classname(), [
      'pluginOptions'=>[
          'singleDatePicker'=>true,
          'showDropdowns'=>true,
          'locale'=>['format' => 'YYYY-MM-DD'],
      ],
  ]);
    ?>

    <?= $form->field($model, 'faq_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'posted_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use frontend\models\NewsCatg;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model frontend\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

    <?php $form = ActiveForm::begin(); ?>

   <?php
    $news  = ArrayHelper::map(NewsCatg::find()->all(), 'catg_id', 'catg_desc'); 
    ?>
     <?= $form->field($model, 'catg_id')->widget(Select2::classname(), [
          
          'data' => $news,
          //'language' => '',
          'options' => ['placeholder' => 'Select News Category'],
          'pluginEvents'=>[
            ]
          ]); ?>

    <?= $form->field($model, 'news_title')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'news_date')->widget(DateRangePicker::classname(), [
      'pluginOptions'=>[
          'singleDatePicker'=>true,
          'showDropdowns'=>true,
          'locale'=>['format' => 'YYYY-MM-DD'],
      ],
  ]);
    ?>

    <?= $form->field($model, 'news_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'posted_by')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

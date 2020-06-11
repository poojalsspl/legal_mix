<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\DictionaryMast;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model frontend\models\Dictionary */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="dictionary-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'word')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'defination')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'synonym')->textInput(['maxlength' => true]) ?>

    <?php $dictionary = ArrayHelper::map(DictionaryMast::find()->all(),'dictionary_code','dictionary_name');?>
    <?= $form->field($model, 'dictionary_code')->widget(Select2::classname(), [
          'data' => $dictionary,
          'options' => ['placeholder' => 'Select Dictionary'],
          'pluginEvents'=>[
            ]
          ]); ?>

<div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

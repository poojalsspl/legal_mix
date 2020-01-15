<?php
use kartik\time\TimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\CaseDetl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="case-detl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'hearing_date')->textInput() ?>

     <?php 
     echo $form->field($model, 'hearing_date')->widget(DatePicker::className(), ['language' => 'en', 'options' => ['placeholder' => 'Select hearing_date ...','style'=>'width:220px'], 'pluginOptions' => ['format' => 'yyyy-mm-dd', 'todayHighlight' => true]]); ?>

      <?php 
     echo $form->field($model, 'next_hearing_date')->widget(DatePicker::className(), ['language' => 'en', 'options' => ['placeholder' => 'Select next hearing_date ...','style'=>'width:220px'], 'pluginOptions' => ['format' => 'yyyy-mm-dd', 'todayHighlight' => true]]); ?>

    <?php //$form->field($model, 'start_time')->textInput() 
    echo TimePicker::widget([
    'name' => 'start_time', 
    'value' => '9:00 AM',
    'size' => 'sm',
    'pluginOptions' => [
        'showMeridian' => false,
        'minuteStep' => 1,
        'showSeconds' => false,
        'style'=>'width:50px'
    ]
]);
?>
    <?= $form->field($model, 'lawyers_name')->textInput(['style'=>'width:300px']) ?>

    <?= $form->field($model, 'judges_name')->textInput(['style'=>'width:300px']) ?>

    <?php // $form->field($model, 'next_hearing_date')->textInput() ?>

    <?= $form->field($model, 'case_charged')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'case_notes')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

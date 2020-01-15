<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InvcDetl */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="invc-detl-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'invc_numb')->textInput() ?>

    <?= $form->field($model, 'invc_qty')->textInput() ?>

    <?= $form->field($model, 'invc_rate')->textInput() ?>

    <?= $form->field($model, 'invc_amt')->textInput() ?>

    <?= $form->field($model, 'invc_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'disc')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JcatgMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="jcatg-mast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'jcatg_description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

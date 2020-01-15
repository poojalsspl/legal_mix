<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentJurisdiction */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="judgment-jurisdiction-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'judgment_jurisdiction_text')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

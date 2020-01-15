<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JournalMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-mast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'journal_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shrt_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pub_freq')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

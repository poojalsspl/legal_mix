<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JournalMastSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="journal-mast-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'journal_code') ?>

    <?= $form->field($model, 'journal_name') ?>

    <?= $form->field($model, 'shrt_name') ?>

    <?= $form->field($model, 'pub_freq') ?>

    <?= $form->field($model, 'remark') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentPartiesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="judgment-parties-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'judgment_party_id') ?>

    <?= $form->field($model, 'judgment_code') ?>

    <?= $form->field($model, 'party_name') ?>

    <?= $form->field($model, 'party_flag') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

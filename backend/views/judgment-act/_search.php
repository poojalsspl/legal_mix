<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentActSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="judgment-act-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'jact') ?>

    <?= $form->field($model, 'judgment_code') ?>

    <?= $form->field($model, 'bareact_catgid') ?>

    <?= $form->field($model, 'bareact_catg_name') ?>

    <?= $form->field($model, 'bareact_id') ?>

    <?php // echo $form->field($model, 'act_name') ?>

    <?php // echo $form->field($model, 'catg_id') ?>

    <?php // echo $form->field($model, 'catg_title') ?>

    <?php // echo $form->field($model, 'country_code') ?>

    <?php // echo $form->field($model, 'country_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

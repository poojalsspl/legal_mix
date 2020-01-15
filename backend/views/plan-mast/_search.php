<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PlanMastSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-mast-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'plan_code') ?>

    <?= $form->field($model, 'plan_name') ?>

    <?= $form->field($model, 'plan_expiry') ?>

    <?= $form->field($model, 'plan_rate') ?>

    <?= $form->field($model, 'coupon_allowed') ?>

    <?php // echo $form->field($model, 'plan_desc') ?>

    <?php // echo $form->field($model, 'search_limit') ?>

    <?php // echo $form->field($model, 'access_limit') ?>

    <?php // echo $form->field($model, 'access_rate_limit') ?>

    <?php // echo $form->field($model, 'concurrent_connection') ?>

    <?php // echo $form->field($model, 'plan_taxed') ?>

    <?php // echo $form->field($model, 'static_ip') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

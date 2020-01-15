<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CaseMastSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="case-mast-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'Id') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'cust_id') ?>

    <?= $form->field($model, 'case_type_id') ?>

    <?= $form->field($model, 'case_desc') ?>

    <?php // echo $form->field($model, 'case_reg_date') ?>

    <?php // echo $form->field($model, 'case_over_date') ?>

    <?php // echo $form->field($model, 'appeal_number') ?>

    <?php // echo $form->field($model, 'court_code') ?>

    <?php // echo $form->field($model, 'appellant_name') ?>

    <?php // echo $form->field($model, 'respondant_name') ?>

    <?php // echo $form->field($model, 'case_summary') ?>

    <?php // echo $form->field($model, 'case_fees') ?>

    <?php // echo $form->field($model, 'case_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

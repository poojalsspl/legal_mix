<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CustMastSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cust-mast-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'custid') ?>

    <?= $form->field($model, 'custname') ?>

    <?= $form->field($model, 'userid') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'custlogo') ?>

    <?php // echo $form->field($model, 'regsdate') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'mobile1') ?>

    <?php // echo $form->field($model, 'mobile2') ?>

    <?php // echo $form->field($model, 'fax') ?>

    <?php // echo $form->field($model, 'tele') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'custaddr') ?>

    <?php // echo $form->field($model, 'city_code') ?>

    <?php // echo $form->field($model, 'city_name') ?>

    <?php // echo $form->field($model, 'state_code') ?>

    <?php // echo $form->field($model, 'state_name') ?>

    <?php // echo $form->field($model, 'country_code') ?>

    <?php // echo $form->field($model, 'country_name') ?>

    <?php // echo $form->field($model, 'panno') ?>

    <?php // echo $form->field($model, 'gstno') ?>

    <?php // echo $form->field($model, 'adharno') ?>

    <?php // echo $form->field($model, 'cust_status_id') ?>

    <?php // echo $form->field($model, 'cust_status_name') ?>

    <?php // echo $form->field($model, 'cust_type_id') ?>

    <?php // echo $form->field($model, 'cust_type_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

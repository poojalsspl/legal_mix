<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlanMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-mast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plan_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_expiry')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_allowed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'search_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_rate_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'concurrent_connection')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_taxed')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'static_ip')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

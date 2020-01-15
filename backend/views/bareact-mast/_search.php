<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BareactMastSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bareact-mast-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'bareact_id') ?>

    <?= $form->field($model, 'old_bareact_id') ?>

    <?= $form->field($model, 'source_act_id') ?>

    <?= $form->field($model, 'act_name') ?>

    <?= $form->field($model, 'bareact_catgid') ?>

    <?php // echo $form->field($model, 'bareact_catg_name') ?>

    <?php // echo $form->field($model, 'tot_section') ?>

    <?php // echo $form->field($model, 'tot_chap') ?>

    <?php // echo $form->field($model, 'Enactment_date') ?>

    <?php // echo $form->field($model, 'bareact_text') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\BareactDetailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bareact-detail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'catg_id') ?>

    <?= $form->field($model, 'bareact_id') ?>

    <?= $form->field($model, 'source_catg_id') ?>

    <?= $form->field($model, 'old_catg_id') ?>

    <?= $form->field($model, 'catg_type') ?>

    <?php // echo $form->field($model, 'catg_title') ?>

    <?php // echo $form->field($model, 'Enactment_date') ?>

    <?php // echo $form->field($model, 'catg_text') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

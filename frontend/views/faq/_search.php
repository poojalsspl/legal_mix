<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\FaqSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="faq-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'faq_id') ?>

    <?= $form->field($model, 'faq_catg_id') ?>

    <?= $form->field($model, 'faq_title') ?>

    <?= $form->field($model, 'faq_date') ?>

    <?= $form->field($model, 'faq_desc') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'posted_by') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

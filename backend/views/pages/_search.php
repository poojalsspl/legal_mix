<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PagesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'page_id') ?>

    <?= $form->field($model, 'page_cat') ?>

    <?= $form->field($model, 'page_meta_keywords') ?>

    <?= $form->field($model, 'page_meta_desc') ?>

    <?= $form->field($model, 'page_title') ?>

    <?php // echo $form->field($model, 'page_image') ?>

    <?php // echo $form->field($model, 'page_abstract') ?>

    <?php // echo $form->field($model, 'page_body') ?>

    <?php // echo $form->field($model, 'page_tag') ?>

    <?php // echo $form->field($model, 'page_status') ?>

    <?php // echo $form->field($model, 'page_cr_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

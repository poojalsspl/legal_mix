<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CategoriesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'cat_id') ?>

    <?= $form->field($model, 'cat_title') ?>

    <?= $form->field($model, 'cat_meta_keywords') ?>

    <?= $form->field($model, 'cat_meta_desc') ?>

    <?= $form->field($model, 'cat_root') ?>

    <?php // echo $form->field($model, 'cat_image') ?>

    <?php // echo $form->field($model, 'cat_desc') ?>

    <?php // echo $form->field($model, 'cat_nav') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

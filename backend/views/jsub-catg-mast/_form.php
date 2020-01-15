<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\JcatgMast;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\JsubCatgMast */
/* @var $form yii\widgets\ActiveForm */

$category = ArrayHelper::map(JcatgMast::find()->all(), 'jcatg_id', 'jcatg_description');

?>

<div class="jsub-catg-mast-form">

    <?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'jcatg_id')->dropDownList($category,['prompt' => 'Select Description']) ?>
    <?= $form->field($model, 'jsub_catg_description')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

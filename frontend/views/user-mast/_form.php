<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-mast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'userid')->textInput() ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_pic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sign_date')->textInput() ?>

    <?= $form->field($model, 'bar_reg_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dob')->textInput() ?>

    <?= $form->field($model, 'mobile_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'landline_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'landline_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alt_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grad_yr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'practice_since')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_code')->textInput() ?>

    <?= $form->field($model, 'city_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'state_code')->textInput() ?>

    <?= $form->field($model, 'state_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'country_code')->textInput() ?>

    <?= $form->field($model, 'country_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pin_code')->textInput() ?>

    <?= $form->field($model, 'status')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

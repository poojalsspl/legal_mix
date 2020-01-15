<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\PlanMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="plan-mast-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'plan_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'plan_expiry')->dropDownList(['1'=>'1','7'=>'7','30'=>'30','365'=>'365']) ?>

    <?= $form->field($model, 'plan_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coupon_allowed')->dropDownList(['yes'=>'Yes','no'=>'No']) ?>

    <?= $form->field($model, 'plan_desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'search_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'access_rate_limit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'concurrent_connection')->dropDownList(['1'=>'0','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10']) ?>

    <?= $form->field($model, 'plan_taxed')->dropDownList(['yes'=>'Yes','no'=>'No']) ?>

    <?= $form->field($model, 'static_ip')->dropDownList(['yes'=>'Yes','no'=>'No']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
    $this->registerJs("CKEDITOR.replace('plan-mast-plan_desc')");

?>

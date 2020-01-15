<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\BareactDetail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bareact-detail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'catg_id')->textInput() ?>

    <?= $form->field($model, 'bareact_id')->textInput() ?>

    <?= $form->field($model, 'source_catg_id')->textInput() ?>

    <?= $form->field($model, 'old_catg_id')->textInput() ?>

    <?= $form->field($model, 'catg_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'catg_title')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'Enactment_date')->widget(DateRangePicker::classname(), [
    'pluginOptions'=>[
        'singleDatePicker'=>true,
        'showDropdowns'=>true,
        'locale'=>['format' => 'YYYY-MM-DD'],
        
        ],
    ]);
  ?>

    <?= $form->field($model, 'catg_text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
    $this->registerJs("CKEDITOR.replace('bareactdetail-catg_text')");
    
?>


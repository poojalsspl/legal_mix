<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\BareactCatg;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\BareactMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bareact-mast-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php $bareactCatg = ArrayHelper::map(BareactCatg::find()->all(), 'bareact_catgid', 'bareact_catg_name'); ?>


        <?= $form->field($model, 'bareact_catg_name')->dropDownList($bareactCatg, ['prompt' => 'Select Category',
            'value' => (!$model->isNewRecord) ? $model->bareact_catgid : '',
            "onchange"=>"
                                                    var code = $(this).val();
                                                    $('#bareactmast-bareact_catgid').val(code);
                                                   "]) ?>


    <?= $form->field($model, 'bareact_catgid')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'bareact_id')->textInput() ?>

    <?= $form->field($model, 'old_bareact_id')->textInput() ?>

    <?= $form->field($model, 'source_act_id')->textInput() ?>

    <?= $form->field($model, 'act_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tot_section')->textInput() ?>

    <?= $form->field($model, 'tot_chap')->textInput() ?>

  <?= $form->field($model, 'Enactment_date')->widget(DateRangePicker::classname(), [
    'pluginOptions'=>[
        'singleDatePicker'=>true,
        'showDropdowns'=>true,
        'locale'=>['format' => 'YYYY-MM-DD'],

    ],
]);
  ?>
    <?= $form->field($model, 'bareact_text')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
    $this->registerJs("CKEDITOR.replace('bareactmast-bareact_text')");

   // $this->registerJs("CKEDITOR.replace('pages-page_abstract')");

?>

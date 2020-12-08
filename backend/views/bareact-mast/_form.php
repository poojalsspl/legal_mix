<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\BareactCatgMast;
use yii\helpers\ArrayHelper;
use kartik\daterange\DateRangePicker;


/* @var $this yii\web\View */
/* @var $model backend\models\BareactMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bareact-mast-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php $bareactCatg = ArrayHelper::map(BareactCatgMast::find()->all(), 'act_catg_code', 'act_catg_desc'); ?>


        
    <?= $form->field($model, 'act_catg_desc')->dropDownList($bareactCatg, ['prompt' => 'Select Category',
        'value' => (!$model->isNewRecord) ? $model->act_catg_code : '',
        "onchange"=>"
                      var code = $(this).val();
                      $('#bareactmast-act_catg_code').val(code);
                      "]) ?>                                           

    <?= $form->field($model, 'act_catg_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'bareact_code')->textInput() ?>

    <?= $form->field($model, 'tot_section')->textInput() ?>

    <?= $form->field($model, 'tot_chap')->textInput() ?>

    <?= $form->field($model, 'enact_date')->widget(DateRangePicker::classname(), [
        'pluginOptions'=>[
        'singleDatePicker'=>true,
        'showDropdowns'=>true,
        'locale'=>['format' => 'YYYY-MM-DD'],
       ],
      ]);
    ?>
    
    <?= $form->field($model, 'bareact_desc')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php 
    $this->registerJs("CKEDITOR.replace('bareactmast-bareact_desc')");

   // $this->registerJs("CKEDITOR.replace('pages-page_abstract')");

?>

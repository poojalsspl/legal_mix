<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use backend\models\Categories;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use dosamigos\ckeditor\CKEditor;
/* @var $this yii\web\View */
/* @var $model backend\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>


    <?php $catMast = ArrayHelper::map(Categories::find()->select('cat_id,cat_title')->all(), 'cat_id', 'cat_title'); ?>
        <?= $form->field($model, 'page_cat')->widget(Select2::classname(), [            
            'data' => $catMast,
            'options' => ['placeholder' => 'Select Category'],
            'pluginEvents'=>[
            	"select2:select" => "function() { var val = $(this).val();      
              $('#pages-page_cat').val(val); 
          }
              "
            ]
            ]); ?>        


    <?= $form->field($model, 'page_meta_keywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_meta_desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'page_title')->textInput(['maxlength' => true]) ?>

     <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title ">Image</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
            <div class="row">
             <div class="col-xs-6">
                    <?= $form->field($model, 'page_image')->fileInput() ?>
             </div>
             <div class="col-xs-3">
             <?php if(!$model->isNewRecord) { ?>
                 <img id="blah" src="<?= Yii::getAlias('@web').'/images/pages/'.$model->page_image ?>" alt="your image"  height="100%" width="100%"/>
             <?php } else { ?>
                 <img id="blah" src="<?= Yii::getAlias('@web').'/images/pages/no-image.png' ?>" alt="your image"  height="100%" width="100%"/>
             <?php } ?>
             </div>    
            </div>
        </div>
     </div>

	<?= $form->field($model, 'page_abstract')->widget(CKEditor::className(), [
	        'options' => ['rows' => 6],
	        'preset' => 'basic'
	    ]) ?>

	 <?= $form->field($model, 'page_body')->widget(CKEditor::className(), [
	        'options' => ['rows' => 6],
	        'preset' => 'basic'
	    ]) ?>


    <?= $form->field($model, 'page_tag')->dropDownList([ '1'=>'Featured', '2'=>'Slider','3'=>"Editor's Pick" ], ['prompt' => 'Select']) ?>

    <?= $form->field($model, 'page_status')->dropDownList([ '0'=>'Active', '1'=>'Inactive', ], ['prompt' => 'Select']) ?>

     <?= $form->field($model, 'page_cr_date')->widget(DateRangePicker::classname(), [
      'pluginOptions'=>[
          'singleDatePicker'=>true,
          'showDropdowns'=>true,
          'locale'=>['format' => 'YYYY-MM-DD'],
      ],
  ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
<?php
$customScript = <<< SCRIPT
    CKEDITOR.replace('pages-page_body');
    CKEDITOR.replace('pages-page_abstract');
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);
?>

<?php 
$customScript = <<< SCRIPT
$("#pages-page_image").on('change', function () {
        if (typeof (FileReader) != "undefined") {
            var reader = new FileReader();
            reader.onload = function (e) {
                 $('#blah').attr('src', e.target.result);
            }
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }
    })
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_END);
?>

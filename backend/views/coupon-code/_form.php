<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model backend\models\CouponCode */
/* @var $form yii\widgets\ActiveForm */
?>


    <div class="box box-danger">
    <div class="coupon-code-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
     <div class="form-group">
        <div class="col-xs-4">
        <?= $form->field($model, 'rand_code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-xs-4">
            <?= $form->field($model, 'gen_date')->textInput(["readOnly"=>true]) ?>
         </div>   
        <div class="col-xs-4">        
        <?= Html::button('Generate', ['class' => 'btn btn-danger generate-data']) ?>
        </div>
    </div>
   </div> 

 <div class="row">
   <div class="col-xs-4">
     <?= $form->field($model, 'exp_date')->widget(DateRangePicker::classname(), [
      'pluginOptions'=>[
          'singleDatePicker'=>true,
          'showDropdowns'=>true,
          'locale'=>['format' => 'YYYY-MM-DD'],
      ],
  ]);
    ?>
    </div>
    <div class="col-xs-4">
        <?= $form->field($model, 'use_limit')->textInput() ?>
    </div>
    <div class="col-xs-3">
     <?= $form->field($model, 'used')->textInput() ?>
     </div>   
    </div>
    <div class="row">
       <div class="col-xs-4">
            <?php if($model->isNewRecord){  $model->discount_type  = 0; } ?>
             <?= $form->field($model, 'discount_type')->radioList(['0' => 'Percentage', '1' => 'Absolute']) ?>
        </div>
   <div class="col-xs-4">
            <?= $form->field($model, 'discount_val')->textInput() ?>
    </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
</div>
<?php
$customScript = <<< SCRIPT
   
$('.generate-data').on('click',function(){
  var randomTxt = function makeid() {
  var text = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  for (var i = 0; i <=5; i++)
    text += possible.charAt(Math.floor(Math.random() * possible.length));
  return text;
}
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
} 
if(mm<10){
    mm='0'+mm;
} 
var today = yyyy+'-'+ mm +'-'+ dd;

$("#couponcode-rand_code").val(randomTxt);
$("#couponcode-rand_code").attr('readonly','ture');
$("#couponcode-gen_date").val(today);

});      
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);

 ?>
<style type="text/css">
	.box.box-danger{
		padding:15px 15px 15px 15px;
	}
</style>
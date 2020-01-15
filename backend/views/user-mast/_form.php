<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use yii\helpers\ArrayHelper;
use backend\models\CountryMast;


/* @var $this yii\web\View */
/* @var $model backend\models\UserMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-mast-form">

    <div class="coupon-code-form box box-danger">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
     <div class="col-xs-4">
        <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    </div>
     <div class="col-xs-4">
         <?php if($model->isNewRecord) { $model->sign_date = date('d-m-Y'); } ?>

    <?= $form->field($model, 'sign_date')->textInput(['readonly'=>true]) ?>

    </div>
    </div>
        <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title ">Profile Image</h3>              
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div class="box-body">
            <div class="row">
             <div class="col-xs-6">
                    <?= $form->field($model, 'user_pic')->fileInput() ?>
             </div>
             <div class="col-xs-3">
             <?php $month = date('M',strtotime($model->sign_date));  ?>
             <?php if(!$model->isNewRecord) { ?>
                 <img id="blah" src="<?= Yii::getAlias('@web') ?>/profilepic/'.$model->image ?>" alt="your image"  height="100%" width="100%"/>
             <?php } else { ?>
                 <img id="blah" src="<?= Yii::getAlias('@web') ?>/profilepic/no-image.png" alt="your image"  height="100%" width="100%"/>
             <?php } ?>
             </div>    
            </div>
        </div>
     </div>
        <?php /*$form->field($model, 'user_pic')->textInput(['maxlength' => true])*/ ?>


    <?= $form->field($model, 'bar_reg_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->radioList(['male' => 'male','female'=>'female']) ?>

     <?= $form->field($model, 'dob')->widget(DateRangePicker::classname(), [
      'pluginOptions'=>[
          'singleDatePicker'=>true,
          'showDropdowns'=>true,
          'locale'=>['format' => 'YYYY-MM-DD'],
      ],
  ]); ?>

    <?= $form->field($model, 'mobile_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'landline_1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'landline_2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'alt_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grad_yr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'practice_since')->textInput(['maxlength' => true]) ?>

    <?php $country = ArrayHelper::map(CountryMast::find()->all(), 'country_name', 'country_name'); ?>

     <?= $form->field($model, 'country_name')->dropDownList($country, ['prompt' => 'Select Country',"onchange"=>"
                                                   var code = $('#usermast-country_name').val();
                                                    $.ajax({
                                                          //type     :'GET',
                                                            url      : '/cjadmin/city-mast/country?id='+code,
                                                            dataType: 'json',
                                                            success  : function(data) {
                                                              $('#usermast-country_shrt_name').val(data.country.shrt_name);
                                                              $('#usermast-country_code').val(data.country.country_code);
                                                              $('#usermast-state_name option').remove();
                                                              $('#usermast-state_name').append('<option>Select State</option>');

                                                              $.each(data.state, function(i, item){
                                                                 //console.log(item.state_name);   
                                                              $('#usermast-state_name').append('<option value='+item.state_code+'>'+item.state_name+'</option>');
                                                          });
                                                          },
                                                          error: function(xhr, textStatus, errorThrown){
                                                               alert('No states for this contry');
                                                            }                                                         
                                                          });"]) ?>


    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'state_name')->dropDownList([],['prompt' => 'Select State',"onchange"=>"
                                                   var code = $('#usermast-state_name').val();
                                                   console.log(code);
                                                    $.ajax({
                                                          //type     :'GET',
                                                            url      : '/cjadmin/city-mast/state?id='+code,
                                                            dataType: 'json',
                                                            success  : function(data) {
                                                            console.log(data); 
                                                             //$('#usermast-state_shrt_name').val(data.shrt_name);
                                                              $('#usermast-state_code').val(data.state_code);
                                                              $('#usermast-city_name option').remove();
                                                              $('#usermast-city_name').append('<option>Select City</option>');

                                                              $.each(data.city, function(i, item){
                                                                 console.log(item);   
                                                              $('#usermast-city_name').append('<option value='+item.city_code+'>'+item.city_name+'</option>');
                                                            });
                                                          },
                                                          error: function(xhr, textStatus, errorThrown){
                                                               alert('No states for this contry');
                                                            }                                                                     });"]) ?>


    <?= $form->field($model, 'state_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'city_name')->dropDownList([],['prompt' => 'Select City',"onchange"=>"
                                                   var code = $('#usermast-state_name').val();
                                                   $('#usermast-city_code').val(code);   
                                                          });"]) ?>

     <?= $form->field($model, 'city_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'pin_code')->textInput() ?>    

    <?= $form->field($model, 'user_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(['Active'=>'Active','Inactive'=>'Inactive']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
  </div>
</div>

<?php

$this->registerJs("$('#user-mast-grad_yr').datepicker({
   format: 'yyyy', // Notice the Extra space at the beginning
    viewMode: 'years', 
    minViewMode: 'years',
    autoclose: true,
});
$('#user-mast-practice_since').datepicker({
   format: 'yyyy', // Notice the Extra space at the beginning
    viewMode: 'years', 
    minViewMode: 'years',
    autoclose: true,
});
");
 ?>
<style type="text/css">
    .box.box-danger{
        padding:15px 15px 15px 15px;
    }
</style>
<?php 
$customScript = <<< SCRIPT
	    $("#usermast-user_pic").change(function(){

        if (typeof (FileReader) != "undefined") {

            var image_holder = $("#usermast-user_pic");
            image_holder.empty();
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);

            }
            image_holder.show();
            reader.readAsDataURL($(this)[0].files[0]);
        } else {
            alert("This browser does not support FileReader.");
        }


    });
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);

?>
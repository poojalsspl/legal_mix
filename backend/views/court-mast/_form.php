<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\CountryMast;
/* @var $this yii\web\View */
/* @var $model backend\models\CourtMast */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$country = ArrayHelper::map(CountryMast::find()->all(), 'country_name', 'country_name');


 ?>

<div class="court-mast-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'country_name')->dropDownList($country, ['prompt' => 'Select Country',"onchange"=>"
                                                   var code = $('#courtmast-country_name').val();
                                                    $.ajax({
                                                          //type     :'GET',
                                                            url      : '/cjadmin/city-mast/country?id='+code,
                                                            dataType: 'json',
                                                            success  : function(data) {
                                                              $('#courtmast-country_shrt_name').val(data.country.shrt_name);
                                                              $('#courtmast-country_code').val(data.country.country_code);
                                                              $('#courtmast-state_name option').remove();
                                                              $('#courtmast-state_name').append('<option>Select State</option>');

                                                              $.each(data.state, function(i, item){
                                                                 //console.log(item.state_name);   
                                                              $('#courtmast-state_name').append('<option value='+item.state_code+'>'+item.state_name+'</option>');
                                                          });
                                                          },
                                                          error: function(xhr, textStatus, errorThrown){
                                                               alert('No states for this contry');
                                                            }                                                         
                                                          });"]) ?>


    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'state_name')->dropDownList([],['prompt' => 'Select State',"onchange"=>"
                                                   var code = $('#courtmast-state_name').val();
                                                   console.log(code);
                                                    $.ajax({
                                                          //type     :'GET',
                                                            url      : '/cjadmin/city-mast/state?id='+code,
                                                            dataType: 'json',
                                                            success  : function(data) {
                                                            console.log(data); 
                                                             //$('#courtmast-state_shrt_name').val(data.shrt_name);
                                                              $('#courtmast-state_code').val(data.state_code);
                                                              $('#courtmast-city_name option').remove();
                                                              $('#courtmast-city_name').append('<option>Select City</option>');

                                                              $.each(data.city, function(i, item){
                                                                 console.log(item);   
                                                              $('#courtmast-city_name').append('<option value='+item.city_code+'>'+item.city_name+'</option>');
                                                            });
                                                          },
                                                          error: function(xhr, textStatus, errorThrown){
                                                               alert('No states for this contry');
                                                            }                                                                     });"]) ?>


    <?= $form->field($model, 'state_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'city_name')->dropDownList([],['prompt' => 'Select City',"onchange"=>"
                                                   var code = $('#courtmast-state_name').val();
                                                   $('#courtmast-city_code').val(code);   
                                                          });"]) ?>

     <?= $form->field($model, 'city_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>


    <?= $form->field($model, 'court_code')->textInput() ?>

    <?= $form->field($model, 'court_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'court_shrt_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'court_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bench_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'court_status')->textInput(['maxlength' => true]) ?>

   

    <?= $form->field($model, 'court_remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'court_address')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

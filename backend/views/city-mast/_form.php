<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CountryMast;
use backend\models\StateMast;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\CityMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="city-mast-form">

    <?php $form = ActiveForm::begin(); ?>

<?php
$country = ArrayHelper::map(CountryMast::find()->all(), 'country_name', 'country_name');
$state = ArrayHelper::map(StateMast::find()->all(), 'state_name', 'state_name');


 ?>

 <?= $form->field($model, 'country_name')->dropDownList($country, ['prompt' => 'Select Country',"onchange"=>"
                                                   var code = $('#citymast-country_name').val();
                                                    $.ajax({
                                                          //type     :'GET',
                                                            url      : '/cjadmin/city-mast/country?id='+code,
                                                            dataType: 'json',
                                                            success  : function(data) {
                                                              $('#citymast-country_shrt_name').val(data.country.shrt_name);
                                                              $('#citymast-country_code').val(data.country.country_code);
                                                              $('#citymast-state_name option').remove();
                        $('#citymast-state_name').append('<option>Select State</option>');

                                                              $.each(data.state, function(i, item){
                                                                 //console.log(item.state_name);   
    $('#citymast-state_name').append('<option value='+item.state_code+'>'+item.state_name+'</option>');
});
                                                          },
                                                          error: function(xhr, textStatus, errorThrown){
                                                               alert('No states for this contry');
                                                            }                                                         
                                                          });"]) ?>

    <?= $form->field($model, 'country_shrt_name')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'state_name')->dropDownList([],['prompt' => 'Select State',"onchange"=>"
                                                   var code = $('#citymast-state_name').val();
                                                   console.log(code);
                                                    $.ajax({
                                                          //type     :'GET',
                                                            url      : '/cjadmin/city-mast/state?id='+code,
                                                            dataType: 'json',
                                                            success  : function(data) {
                                                            console.log(data); 
                                                              $('#citymast-state_shrt_name').val(data.shrt_name);
                                                              $('#citymast-state_code').val(data.state_code);
                                                          }
                                                         
                                                          });"]) ?>

    <?= $form->field($model, 'state_shrt_name')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'state_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'city_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shrt_name')->textInput(['maxlength' => true]) ?>

     <?= $form->field($model, 'city_code')->textInput() ?>

    <?= $form->field($model, 'court_stat')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\CountryMast;

/* @var $this yii\web\View */
/* @var $model backend\models\BareactCatg */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bareact-catg-form">

<?php
$country = ArrayHelper::map(CountryMast::find()->all(), 'country_code', 'country_name');


 ?>

    <?php $form = ActiveForm::begin(); ?>



        <?= $form->field($model, 'country_name')->dropDownList($country, ['prompt' => 'Select Country',"onchange"=>"
                                                   var code = $('#bareactcatg-country_name').val();
                                                    $.ajax({
                                                          //type     :'GET',
                                                            url      : '/cjadmin/bareact-catg/country?id='+code,
                                                            dataType: 'json',
                                                            success  : function(data) {
                                                   console.log(data); 
                                                             
                                                              $('#bareactcatg-country_code').val(data.country_code);
                                                          }
                                                         
                                                          });"]) ?>

    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'bareact_catgid')->textInput() ?>

    <?= $form->field($model, 'bareact_catg_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

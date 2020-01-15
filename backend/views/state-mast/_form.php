<?php
use Yii;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\CountryMast;
use kartik\daterange\DateRangePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\StateMast */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="state-mast-form">

               <?php //$path = Yii::getAlias('@backEnd'); ?>
    <?php $form = ActiveForm::begin(); ?>
<?php
$country = ArrayHelper::map(CountryMast::find()->all(), 'country_code', 'country_name');


 ?>
    <?= $form->field($model, 'country_name')->dropDownList($country, ['prompt' => 'Select Country',"onchange"=>"
                                                   var code = $('#statemast-country_name').val();
                                                    $.ajax({
                                                          //type     :'GET',
                                                            url      : '/cjadmin/state-mast/country?id='+code,
                                                            dataType: 'json',
                                                            success  : function(data) {
                                                   console.log(data); 

                                                              $('#statemast-country_shrt_name').val(data.shrt_name);
                                                              $('#statemast-country_code').val(data.country_code);
                                                          }
                                                         
                                                          });"]) ?>

    <?= $form->field($model, 'country_shrt_name')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'country_code')->textInput(['maxlength' => true,'readonly'=>true]) ?>

    <?= $form->field($model, 'state_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shrt_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zone')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'cr_date')->widget(DateRangePicker::classname(), [
        'pluginOptions'=>[
            'singleDatePicker'=>true,
            'showDropdowns'=>true,
        ],
    ]);
      ?>

    <?= $form->field($model, 'status')->dropDownList(["1"=>"Active", "0"=>"Inactive"]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

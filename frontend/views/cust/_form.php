<?php
use frontend\models\User;
use app\models\UserMast;
use app\models\CustTypeMast;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CountryMast;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use kartik\widgets\DepDrop;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\CustMast */
/* @var $form yii\widgets\ActiveForm */


$country = ArrayHelper::map(CountryMast::find()->all(), 'country_code', 'country_name');
 array_push($country, "Select Country");
 $country = array_reverse($country,true);
?>
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="container">
  <div>
      <div class="panel panel-primary">
      <div class="panel-heading">Customer details</div>
      <div style="margin-left:20px;margin-right:50px">
    <div class="row">
      <div class="col-50">
       <?= $form->field($model, 'custname')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
            <?php 
     echo $form->field($model, 'dob')->widget(DatePicker::className(), ['language' => 'en', 'options' => ['placeholder' => 'Select date of birth ...','style'=>'width:220px'], 'pluginOptions' => ['format' => 'yyyy-mm-dd', 'todayHighlight' => true]]); ?>
      </div>
    </div>
  
   
    <div class="row">
      <div class="col-50">
          <?= $form->field($model, 'custlogo')->fileInput() ?>
        
      </div>
      <div class="col-50">
      </div>
    </div>
   

    <div class="row">
      <div class="col-50">
      <?= $form->field($model, 'panno')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
         <?= $form->field($model, 'gstno')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>

     <div class="row">
      <div class="col-50">
      <?= $form->field($model, 'adharno')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
         <?= $form->field($model, 'cust_type_id')->dropDownList(ArrayHelper::map(CustTypeMast::find()->all(),'cust_type_id','cust_type_name'),['prompt'=>'Select customer type'],['style'=>'width:300px']) ?>
      </div>
    </div>
</div>
</div>

<!--Third Panel contact details -->
<div class="panel panel-primary">
      <div class="panel-heading">Customer Contact details</div>
      <div style="margin-left:20px;margin-right:10px">
   
  
    <div class="row">
      <div class="col-50">
        <?php
     echo $form->field($model, 'custaddr')->textarea(['rows' => '2','cols'=>'2','style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
       <?php
     echo $form->field($model, 'country_code')->dropDownList($country, ['style'=>'width:300px;height:40px;','id'=>'country_code']);?>
      </div>
      </div>
    <div class="row">
      <div class="col-50">
     <?= $form->field($model, 'email')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
       <?php
// Child # 1
     echo $form->field($model, 'state_code')->widget(DepDrop::classname(), [

     'options'=>['style'=>'width:300px;height:40px;','id'=>'state_code'],
     'pluginOptions'=>[
     'depends'=>['country_code'],
     'placeholder'=>'Select state',
     'url'=>\yii\helpers\Url::to(['/site/subcat'])
      ]
      ]);?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
      <?= $form->field($model, 'fax')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
         <?php

// Child # 2
     echo $form->field($model, 'city_code')->widget(DepDrop::classname(), [
        'options'=>['style'=>'width:300px;height:40px;'],
     'pluginOptions'=>[
     'depends'=>['state_code'],
     'placeholder'=>'Select city',
     'url'=>\yii\helpers\Url::to(['/site/getcity'])
     ]
     ]);
     ?>
      </div>
    </div>
      <div class="row">
      <div class="col-50">
       <?= $form->field($model, 'mobile1')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
        <?= $form->field($model, 'mobile2')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
       <?= $form->field($model, 'tele')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
     
      </div>
    </div>
</div>

</div>
 <div class="form-group">
   <div class="row">
      <center><?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?></center>
      </div>
 </div>
<?php ActiveForm::end(); ?>
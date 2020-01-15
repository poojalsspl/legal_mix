<?php
use frontend\models\User;
use app\models\UserMast;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CountryMast;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use kartik\widgets\DepDrop;
use yii\bootstrap\Modal;

$this->title = 'Court Judgement';
  $baseUrl = Yii::$app->params['domainName'];
 $country = ArrayHelper::map(CountryMast::find()->all(), 'country_code', 'country_name');
 array_push($country, "Select Country");
 $country = array_reverse($country,true);
?>
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="container">
  <div style="margin-top:5px;">
     <div class="panel panel-primary">
     <div class="panel-heading">Personal details</div>
     <div style="margin-left:20px;margin-right:10px">
     <div class="row">
     <div class="col-50">
     <?php $image = $model->user_pic;
        if($image==""){
           $image = "default.jpg";
        }
        ?>
        <img src="<?php echo $imag = $baseUrl.'frontend/web/uploads/'.$image ; ?>" class="avatar img-circle img-thumbnail" alt="avatar" height="200" width="200">
        </div>
        <div class="col-50">
            <?= $form->field($model, 'user_pic')->fileInput() ?>
        </div>
    </div>
    <div class="row">
      <div class="col-50">
       <?= $form->field($model, 'email')->textInput(['style'=>'width:300px','readonly'=> true]) ?>
      </div>
      <div class="col-50">
         <?= $form->field($model, 'alt_email')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
       <?= $form->field($model, 'first_name')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
        <?= $form->field($model, 'last_name')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
        <?= $form->field($model, 'gender')->radioList(['M' => 'Male', 'F' => 'Female'])->label('Gender'); ?> 
      </div>
      <div class="col-50">
       <?php 
     echo $form->field($model, 'dob')->widget(DatePicker::className(), ['language' => 'en', 'options' => ['placeholder' => 'Select date of birth ...','style'=>'width:220px'], 'pluginOptions' => ['format' => 'yyyy-mm-dd', 'todayHighlight' => true]]); ?>
      </div>
    </div>
    
   
</div>
</div>
<!--Second Panel company details -->
<div class="panel panel-primary">
      <div class="panel-heading">Professional details</div>
      <div style="margin-left:20px;margin-right:10px">
    <div class="row">
      <div class="col-50">
        <?= $form->field($model, 'user_type')->radioList(['Individual' => 'Individual', 'Corporate' => 'Corporate'])->label('User Type'); ?>
      </div>
      <div class="col-50">
         <?= $form->field($model, 'company_name')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
       <?php $profession = array('Academic/Educator'=>'Academic/Educator','Advocate'=>'Advocate','Chartered Accountant'=>'Chartered Accountant','Company Secretary'=>'Company Secretary','Consultant'=>'Consultant','Corporate'=>'Corporate','Customer Support'=>'Customer Support','Doctor'=>'Doctor','Engineer'=>'Engineer','General Administrator'=>'General Administrator','Government Employee'=>'Government Employee','Inhouse Lawyer'=>'Inhouse Lawyer','IT related'=>'IT related','Retired'=>'Retired','Sales & Marketing'=>'Sales & Marketing','Self Employed'=>'Self Employed','Student'=>'Student','Solicitor'=>'Solicitor','Other'=>'Other');?> 
      <?= $form->field($model, 'profession')->dropDownList($profession,array('style'=>'width:300px;', 'prompt'=>'--Select --')); ?>
      </div>
      <div class="col-50">
        <?php $practise_area = array('Administrative Law'=>'Administrative Law','Banks & Books'=>'Banks & Books','Business Law'=>'Business Law','Civil Practice'=>'Civil Practice','Civil Rights'=>'Civil Rights','Commercial Law'=>'Commercial Law','Constitutional Law'=>'Constitutional Law','Consumer Law'=>'Consumer Law','Copyright'=>'Copyright','Corporate Law'=>'Corporate Law','Criminal Law'=>'Criminal Law','Cyber Law'=>'Cyber Law','Drugs & Narcotics'=>'Drugs & Narcotics','Election,Campaign,Political Law'=>'Election,Campaign,Political Law','Environmental Law'=>'Environmental Law','Family Law'=>'Family Law','Immigration and Naturalization'=>'Immigration and Naturalization','Insurance'=>'Insurance','Intellectual Property'=>'Intellectual Property','International Law'=>'International Law','Military Law'=>'Military Law','Partnership Law'=>'Partnership Law','Property Law'=>'Property Law','Religious Institution'=>'Religious Institution','Texation'=>'Texation','Torts'=>'Torts','Trade & Professional'=>'Trade & Professional','Trade Mocks'=>'Trade Mocks','Unfair Competition'=>'Unfair Competition','Finance Banking'=>'Finance Banking');?> 
     <?= $form->field($model, 'practise_area')->dropDownList($practise_area,array('style'=>'width:300px;', 'prompt'=>'--Select --')); ?>
      </div>
    </div>

    <div class="row">
      <div class="col-50">
      <?= $form->field($model, 'grad_yr')->dropDownList($model->getYearsList(),['style'=>'width:300px;']); ?>
      </div>
      <div class="col-50">
       
     <?= $form->field($model, 'practice_since')->dropDownList($model->getPracticeYears(),['style'=>'width:300px;']); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
      <?= $form->field($model, 'pan_no')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
         <?= $form->field($model, 'gst_no')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>
        <div class="row">

      <div class="col-50">
      <?= $form->field($model, 'bar_reg_no')->textInput(['style'=>'width:300px']) ?>
      </div>
      </div>
</div>
</div>
</div>
<!--Third Panel contact details -->
<div class="panel panel-primary">
      <div class="panel-heading">Contact details</div>
      <div style="margin-left:20px;margin-right:10px">
    <div class="row">
      <div class="col-50">
         <?= $form->field($model, 'landline_1')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
          <?= $form->field($model, 'landline_2')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
       <?= $form->field($model, 'mobile_1')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
        <?= $form->field($model, 'mobile_2')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
        <?php
     echo $form->field($model, 'user_address')->textarea(['rows' => '2','cols'=>'2','style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
       <?php
     echo $form->field($model, 'country_code')->dropDownList($country, ['style'=>'width:300px;height:40px;','id'=>'country_code']);?>
      </div>
      </div>
    <div class="row">
      <div class="col-50">
     <?= $form->field($model, 'pin_code')->textInput(['style'=>'width:300px']) ?>
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
</div>

</div>
 <div class="form-group">
   <div class="row">
      <center><?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?></center>
      </div>
 </div>
    <?php ActiveForm::end(); ?>
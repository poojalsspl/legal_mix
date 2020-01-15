<?php
use frontend\models\User;
use app\models\UserMast;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CountryMast;
use backend\models\StateMast;
use backend\models\CityMast;
use yii\helpers\ArrayHelper;
use kartik\widgets\DepDrop;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use kartik\file\FileInput;
use yii\jui\DatePicker; 





$this->title = 'Update Profile';
    $baseUrl = Yii::$app->params['domainName'];

    $country = ArrayHelper::map(CountryMast::find()->all(), 'country_code', 'country_name');
    array_push($country, "Select Country");
    $country = array_reverse($country,true);
    $profession = ['Academic/Educator'=>'Academic/Educator','Advocate'=>'Advocate','Chartered Accountant'=>'Chartered Accountant','Company Secretary'=>'Company Secretary','Consultant'=>'Consultant','Corporate'=>'Corporate','Customer Support'=>'Customer Support','Doctor'=>'Doctor','Engineer'=>'Engineer','General Administrator'=>'General Administrator','Government Employee'=>'Government Employee','Inhouse Lawyer'=>'Inhouse Lawyer','IT related'=>'IT related','Retired'=>'Retired','Sales & Marketing'=>'Sales & Marketing','Self Employed'=>'Self Employed','Student'=>'Student','Solicitor'=>'Solicitor','Other'=>'Other'];
    $practise_area = ['Administrative Law'=>'Administrative Law','Banks & Books'=>'Banks & Books','Business Law'=>'Business Law','Civil Practice'=>'Civil Practice','Civil Rights'=>'Civil Rights','Commercial Law'=>'Commercial Law','Constitutional Law'=>'Constitutional Law','Consumer Law'=>'Consumer Law','Copyright'=>'Copyright','Corporate Law'=>'Corporate Law','Criminal Law'=>'Criminal Law','Cyber Law'=>'Cyber Law','Drugs & Narcotics'=>'Drugs & Narcotics','Election,Campaign,Political Law'=>'Election,Campaign,Political Law','Environmental Law'=>'Environmental Law','Family Law'=>'Family Law','Immigration and Naturalization'=>'Immigration and Naturalization','Insurance'=>'Insurance','Intellectual Property'=>'Intellectual Property','International Law'=>'International Law','Military Law'=>'Military Law','Partnership Law'=>'Partnership Law','Property Law'=>'Property Law','Religious Institution'=>'Religious Institution','Texation'=>'Texation','Torts'=>'Torts','Trade & Professional'=>'Trade & Professional','Trade Mocks'=>'Trade Mocks','Unfair Competition'=>'Unfair Competition','Finance Banking'=>'Finance Banking'];
?>

<div class="template">
    <div class ="body-content">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="col-md-12">
            <div class="row">
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <div class="box-title">Personal Details</div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="col-md-4 col-xs-12">
                                <div class="profile-preview">
                                    <?=$form->field($model, 'user_pic')->widget(FileInput::classname(), [
                                        'options' => ['accept' => 'image/*'],
                                        'pluginOptions' => [
                                                'showUpload' => false,
                                                'initialPreview' => Html::img('@web/images/uploads/profile.jpg', ['class' => 'profile-update-pic']),
                                                'initialCaption' => 'Logo',
                                            'mainClass' => 'input-group-sm'
                                        ]
                                    ])->label(false);?>

                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">

                                <?= $form->field($model, 'first_name')->textInput(['placeholder' => 'Enter First Name']) ?>

                                <?= $form->field($model, 'email')->textInput(['readonly'=> true, 'placeholder' => 'Enter Email']) ?>
                               
                                <?= $form->field($model, 'dob')->widget(\yii\jui\DatePicker::class, [
                             
                            'dateFormat' => 'dd/MM/yyyy',

                           ]); ?><!--//added for dob //27/7/2019 -->
                          



                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?= $form->field($model, 'last_name')->textInput(['placeholder' => 'Enter Last Name']) ?>

                                <?= $form->field($model, 'alt_email')->textInput(['placeholder' => 'Enter Alt Email']) ?>

                                <?= $form->field($model, 'gender')->radioList(['M' => 'Male', 'F' => 'Female'])->label('Gender'); ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="row">
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <div class="box-title">Professional Details</div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="col-md-4 col-xs-12">
                                <?= $form->field($model, 'user_type')->radioList(['Individual' => 'Individual', 'Corporate' => 'Corporate'])->label('User Type'); ?>
                                
                                <?= $form->field($model, 'bar_reg_no')->textInput(['placeholder' => 'Reg No']) ?>
                                
                                <?= $form->field($model, 'grad_yr')->widget(Select2::classname(), [
                                    'data' => $model->getYearsList(),

                                    'options' => [
                                        'placeholder' => Yii::t('app', 'Grad Year'),
                                        'multiple' => false,
                                        ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>                                
                                
                                <?= $form->field($model, 'gst_no')->textInput([]) ?>
                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?= $form->field($model, 'company_name')->textInput(['placeholder' => 'Company Name']) ?>
                                
                                <?= $form->field($model, 'profession')->widget(Select2::classname(), [
                                    'data' => $profession,

                                    'options' => [
                                        'placeholder' => Yii::t('app', 'Select Proffession'),
                                        'multiple' => false,
                                        ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>
                                
                                <?= $form->field($model, 'practice_since')->widget(Select2::classname(), [
                                    'data' => $model->getPracticeYears(),

                                    'options' => [
                                        'placeholder' => Yii::t('app', 'Select Practise Area'),
                                        'multiple' => false,
                                        ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>                                
                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?= $form->field($model, 'no_of_laywers')->textInput([]) ?>
                                
                                <?= $form->field($model, 'practise_area')->widget(Select2::classname(), [
                                    'data' => $practise_area,

                                    'options' => [
                                        'placeholder' => Yii::t('app', 'Select Practise Area'),
                                        'multiple' => false,
                                        ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); ?>
                                
                                <?= $form->field($model, 'pan_no')->textInput([]) ?>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div class="row">
                <div class="box box-blue">
                    <div class="box-header with-border">
                        <div class="box-title">Contact Details</div>
                    </div>
                    <div class="box-body">
                        <div class="col-md-12">
                            <div class="col-md-4 col-xs-12">
                                <?php /* $form->field($model, 'country_code')->widget(Select2::classname(), [
                                    'data' => $country,

                                    'options' => [
                                        'placeholder' => Yii::t('app', 'Select Country Code'),
                                        'multiple' => false,
                                        ],
                                    'pluginOptions' => [
                                        'allowClear' => true
                                    ],
                                ]); */?>
                                <?php
  echo $form->field($model, 'country_code')->dropDownList($country, ['id'=>'country_code']);?>
                                
                                <?=$form->field($model, 'user_address')->textarea(['rows' => '2','cols'=>'2','style'=>'width:100%'])?>
                                
                                <?= $form->field($model, 'landline_1')->textInput([]) ?>
                                
                                <?= $form->field($model, 'mobile_2')->textInput([]) ?>
                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?=$form->field($model, 'state_code')->widget(DepDrop::classname(), [
                                    'data'=>ArrayHelper::map(StateMast::find()->all(), 'state_code', 'state_name' ),//will show dependent value while upate //27/07
                                    'options'=>['id'=>'state_code', 'placeholder' => 'Select state'],

                                    'pluginOptions'=>[
                                    'depends'=>['country_code'],
                                    'placeholder'=>'Select state',
                                    'url'=>\yii\helpers\Url::to(['/site/subcat'])
                                     ]
                                    ]);?>
                                    


                                
                                <?= $form->field($model, 'pin_code')->textInput([]) ?>
                                
                                <?= $form->field($model, 'landline_2')->textInput([]) ?>                                
                                
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <?=$form->field($model, 'city_code')->widget(DepDrop::classname(), [
                                    'data'=>ArrayHelper::map(CityMast::find()->all(), 'city_code', 'city_name' ),//will show dependent value while upate //27/07
                                    'options'=>['placeholder' => 'Select city'],
                                    'pluginOptions'=>[
                                    'depends'=>['state_code'],
                                    'placeholder'=>'Select city',
                                    'url'=>\yii\helpers\Url::to(['/site/getcity'])
                                    ]
                                ]);?>
                                
                                <?= $form->field($model, 'fax')->textInput([]) ?>
                                
                                <?= $form->field($model, 'mobile_1')->textInput([]) ?>
                                
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group" style="text-align: center">
                <div class="col-md-4 col-md-offset-4">
                   
                    <?= Html::submitButton('Submit', ['class' => 'btn-block btn theme-blue-button ']) ?>
                </div>
                
            </div>
        
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>

<?php
use frontend\models\User;
use app\models\UserMast;
use app\models\CustTypeMast;
use app\models\CaseTypeMast;
use app\models\CustMast;
use app\models\CaseStatusMast;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\CountryMast;
use backend\models\CourtMast;
use yii\helpers\ArrayHelper;
use kartik\widgets\DatePicker;
use kartik\widgets\DepDrop;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\CustMast */
/* @var $form yii\widgets\ActiveForm */

?>
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
<div class="container">
      <div class="panel panel-primary">
      <div class="panel-heading">Case details</div>
      <div class="row">
      <div class="col-50">
        <?php $userid = Yii::$app->user->identity->id; ; 
       // $cust = ArrayHelper::map(CustMast::find()->where('userid = :userid', [':userid' => $userid])->all(),'custid','custname');
        //print_r($cust);
        //exit;

        ?>
         <?= $form->field($model, 'custid')->dropDownList(ArrayHelper::map(CustMast::find()->where('userid = :userid', [':userid' => $userid])->all(),'custid','custname'),array('style'=>'width:300px;','prompt'=>'--Select Customer--')) ?>
      </div>
      <div class="col-50">
         <?= $form->field($model, 'case_type_id')->dropDownList(ArrayHelper::map(CaseTypeMast::find()->all(),'Id','case_type_desc'),array('style'=>'width:300px;','prompt'=>'--Select Case Type--')) ?>
            
      </div>
    </div>
    <div class="row">
      <div class="col-50">
      <?= $form->field($model, 'case_desc')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
       <?php 
     echo $form->field($model, 'case_reg_date')->widget(DatePicker::className(), ['language' => 'en', 'options' => ['placeholder' => 'Select date of birth ...','style'=>'width:220px'], 'pluginOptions' => ['format' => 'yyyy-mm-dd', 'todayHighlight' => true]]); ?>
      </div>
    </div>

     <div class="row">
      <div class="col-50">
        <?= $form->field($model, 'case_fees')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
           <?php
     echo $form->field($model, 'appeal_number')->textInput(['style'=>'width:300px']) ?>
      </div>
   </div>
   <div class="row">
      <div class="col-50">
     <?= $form->field($model, 'court')->dropDownList(ArrayHelper::map(CourtMast::find()->all(),'court_code','court_name'),array('style'=>'width:300px;','prompt'=>'--Select Court--')) ?>
      </div>
      <div class="col-50">
         <?= $form->field($model, 'case_status')->dropDownList(ArrayHelper::map(CaseStatusMast::find()->all(),'Id','case_status_desc'),array('style'=>'width:300px;','prompt'=>'--Select Court--')) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-50">
      <?= $form->field($model, 'appellant_name')->textInput(['style'=>'width:300px']) ?>
      </div>
      <div class="col-50">
         <?= $form->field($model, 'respondant_name')->textInput(['style'=>'width:300px']) ?>
      </div>
    </div>
      <div class="row">
      <div class="col-50">
       <?= $form->field($model, 'case_summary')->textarea(['style'=>'width:750px']) ?>
     </div>
    </div>
    <div class="row">
      <div class="col-50">
         <?php 
     echo $form->field($model, 'case_over_date')->widget(DatePicker::className(), ['language' => 'en', 'options' => ['placeholder' => 'Select date of birth ...','style'=>'width:220px'], 'pluginOptions' => ['format' => 'yyyy-mm-dd', 'todayHighlight' => true]]); ?>
     
      </div>
      <div class="col-50">
       
      </div>
    </div>


</div>
<div class="row">
 <div class="form-group">
   
      <center><?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?></center>
      </div>
 </div>
<?php ActiveForm::end(); ?>

</div>

   

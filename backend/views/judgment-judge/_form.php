<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\JudgmentMast;
use backend\models\JudgmentJudge;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\judgmentjudge */
/* @var $form yii\widgets\ActiveForm */
   $jcode  = '';
    $jcount = '';
    $jyear  = '';
if($_GET)
{
    $jcode = $_GET['jcode'];
    $jcount = $_GET['jcount'];
    $jyear = $_GET['jyear'];
}

$judgment = ArrayHelper::map(JudgmentMast::find()->where(['judgment_code'=>$jcode])->all(),
    'judgment_code',
    function($result) {
        return $result['court_name'].'::'.$result['judgment_title'];
    });



?>

<div class="judgment-judge-form">


<div class="box box-danger col-md-12">
 <?php if($model->isNewRecord) { ?>
 <?php $form = ActiveForm::begin(['method'=>'post']); ?>
           <div class="box-header with-border">
              <h3 class="box-title">Advocate</h3>
            </div>
  <?= $form->field($model, 'judgment_code')->widget(Select2::classname(), [
    'data' => $judgment,
    'disabled'=>true,
     'initValueText' => $jcode,        
    //'language' => '',
    'options' => ['placeholder' => 'Select Judgment Code','value'=>$jcode],

]); ?>
    <div class="dynamic-rows rows col-xs-12">   
      <div class="dynamic-rows-field row">
    
        <div class="col-xs-6">
                <?= $form->field($model, (!$model->isNewRecord) ? 'judge_name' : 'judge_name[]' )->textInput(['maxlength' => true,
                'class'=>'judgmentjudge-judge_name form-control']) ?> 
        </div>
        <div class="col-xs-2">
            
        </div>
       
     </div>
    </div>
    <div class="row form-group">
    <div class="col-xs-4">
        <?= Html::button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', "id"=>'submit-button']) ?>

    </div>
    <div class="col-xs-8">
    <?= Html::button('Add row', ['name' => 'Add', 'value' => 'true', 'class' => 'btn btn-info addr-row']) ?>
    <?= Html::button('Delete row', ['name' => 'Delete', 'value' => 'true', 'class' => 'btn btn-danger deleted-row']) ?>
    <?php if($model->isNewRecord) { ?>
    
    <?= Html::button('Generate Data', ['name' => 'Add', 'value' => 'true', 'class' => 'btn btn-info generate-row']) ?>
  <?php if($jcount != '' && $jyear != ''){ ?>

        <?= Html::a('Next', ['next-page','jcode'=>$jcode,"jcount"=>$jcount,'jyear'=>$jyear],['class' =>  'btn btn-danger pull-right']) ?>
<?php } } ?>  
      </div>
    </div>
    <?php ActiveForm::end(); ?>
    <?php } ?>

   <?php if(!$model->isNewRecord) { ?>
 <?php $form = ActiveForm::begin(['method'=>'post']); ?>
           <div class="box-header with-border">
              <h3 class="box-title">Advocate</h3>
            </div>
  <?= $form->field($model, 'judgment_code')->widget(Select2::classname(), [
    'data' => $judgment,
    'disabled'=>true,
     'initValueText' => $jcode,        
    //'language' => '',
    'options' => ['placeholder' => 'Select Judgment Code','value'=>$jcode],

]); ?>
    <div class="dynamic-rows rows col-xs-12">  

     
        <?php $judge = JudgmentJudge::find()->where(['judgment_code'=>$model->judgment_code])->all();    ?>
<?php foreach ($judge as $jdg) { ?>
     <div class="dynamic-rows-field row">
        <div class="col-xs-6">
                <div class="form-group field-judgmentjudge-judge_name has-success">
                <label class="control-label" for="judgmentjudge-judge_name">Judge Name</label>
                <input type="text" id="judgmentjudge-judge_name" class="judgmentjudge-judge_name form-control" name="JudgmentJudge[judge_name][]" value="<?= $jdg->judge_name ?>" maxlength="50" aria-invalid="false">
                <div class="help-block"></div>
                </div> 
        </div>
        <div class="col-xs-2">            
        </div>       
     </div>
    <?php } ?>     
    </div>
    <div class="row form-group">
    <div class="col-xs-4">
        <?= Html::button($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', "id"=>'submit-button']) ?>

    </div>
    <div class="col-xs-8">
    <?= Html::button('Add row', ['name' => 'Add', 'value' => 'true', 'class' => 'btn btn-info addr-row']) ?>
    <?= Html::button('Delete row', ['name' => 'Delete', 'value' => 'true', 'class' => 'btn btn-danger deleted-row']) ?>
    <?php if($model->isNewRecord) { ?>
    
    <?= Html::button('Generate Data', ['name' => 'Add', 'value' => 'true', 'class' => 'btn btn-info generate-row']) ?>
  <?php if($jcount != '' && $jyear != ''){ ?>

        <?= Html::a('Next', ['next-page','jcode'=>$jcode,"jcount"=>$jcount,'jyear'=>$jyear],['class' =>  'btn btn-danger pull-right']) ?>
    <?php } } ?>  
 <?php if(!$model->isNewRecord) { ?>
 <?= Html::a('Delete All', ['judgment-judge/deleteall', 'jcode' => $jcode], ['class' => 'btn btn-danger pull-right']) ?>
 <?php } ?>    
      </div>
    </div>
    <?php ActiveForm::end(); ?>

    <?php } ?>


    </div>





</div>
<?php 
if($model->isNewRecord){
    $customScript = <<< SCRIPT
    $('.addr-row').on('click',function(){
        $('.dynamic-rows').append('<div class="dynamic-rows-field row"><div class="col-xs-6"><div class="col-xs-6"><div class="form-group field-judgmentjudge-judge_name has-success"><label class="control-label" for="judgmentjudge-judge_name">Judge Name</label><input type="text" id="judgmentjudge-judge_name" class="form-control judgmentjudge-judge_name" name="JudgmentJudge[judge_name][]" maxlength="50" aria-invalid="false"><div class="help-block"></div></div></div></div></div>');    
    });
    $('.deleted-row').on('click',function(){
        console.log('test');
        $('.dynamic-rows-field').last().remove();
    });
    $('#submit-button').on("click",function(){
        console.log('test');
    $('.judgmentjudge-judge_name').each(function(){   
        if($(this).val()=='')
        {
            alert('Judge Name Can not be Empty');
            $(this).focus();
            return false;   
        }
        
    });     
     $('#submit-button').attr('type','submit');
 });


SCRIPT;
}
else{
        $customScript = <<< SCRIPT
    $('.addr-row').on('click',function(){
        $('.judgmentjudge-judge_name').attr('name','JudgmentJudge[judge_name][]')
        $('.dynamic-rows').append('<div class="dynamic-rows-field row"><div class="col-xs-6"><div class="col-xs-6"><div class="form-group field-judgmentjudge-judge_name has-success"><label class="control-label" for="judgmentjudge-judge_name">Judge Name</label><input type="text" id="judgmentjudge-judge_name" class="form-control judgmentjudge-judge_name" name="JudgmentJudge[judge_name][]" maxlength="50" aria-invalid="false"><div class="help-block"></div></div></div></div></div>');    
    });
    $('.deleted-row').on('click',function(){
        console.log('test');
        $('.dynamic-rows-field').last().remove();
    });
    $('#submit-button').on("click",function(){
        console.log('test');
    $('.judgmentjudge-judge_name').each(function(){
        if($(this).val()=='')
        {
            alert('Judge Name Can not be Empty');
            $(this).focus();
            return false;   
        }
        
    });     
     $('#submit-button').attr('type','submit');
 });


SCRIPT;


}
    $this->registerJs($customScript, \yii\web\View::POS_READY);
 ?>
<?php 
$customScript = <<< SCRIPT
$('.generate-row').on('click', function(){
 var judge =  $('#judgmentjudge-judgment_code').val();
 console.log(judge);
 if(judge=='')
 {
    alert('Please Select Judgement code');
 }
 else
$.ajax({
//type     :'GET',
url        : '/cjadmin/judgment-judge/judge?id='+judge,
dataType   : 'json',
success    : function(data){
        console.log(data);
        $('.dynamic-rows div').html('');    

         var res = (data.judges_name).split(";");
         console.log(res.length);
         for(i=0;i<res.length;i++){
            if(res[i])
            {
        $('.dynamic-rows').append('<div class="dynamic-rows-field row"><div class="col-xs-6"><div class="form-group field-judgmentjudge-judge_name has-success"><label class="control-label" for="judgmentjudge-judge_name">Judge Name</label><input type="text" id="judgmentjudge-judge_name" class="form-control judgmentudge-judge_name" name="JudgmentJudge[judge_name][]" maxlength="50" aria-invalid="false" value="'+res[i]+'"><div class="help-block"></div></div></div></div></div>');
            }
            }
    },
        error: function(xhr, textStatus, errorThrown){
        //alert('No states for this contry');
    }                                                         
    });
//console.log(advocate);
}); 
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);

?>

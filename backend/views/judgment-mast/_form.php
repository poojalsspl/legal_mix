<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\JsubCatgMast;
use backend\models\JcatgMast;
use backend\models\JudgmentMast;
use backend\models\CityMast;
use backend\models\Categories;
use backend\models\CourtMast;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\daterange\DateRangePicker;
use backend\models\JudgmentBenchType;
use backend\models\JudgmentDisposition;
use backend\models\JudgmentJurisdiction;
/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentMast */
/* @var $form yii\widgets\ActiveForm */
$cache = Yii::$app->cache;

?>

<div class="judgment-mast-form">

<!--  <ul class="nav nav-pills">
     <li class="master1 active"><a data-toggle="pill" href="#master-1">Master 1</a></li>
     <li class="master2"><a data-toggle="pill" href="#master-2">Master 2</a></li>
     <li class="master3"><a data-toggle="pill" href="#master-3">Master 3</a></li>
 </ul> -->


 <?php $form = ActiveForm::begin(['id'=>'judge-master']); ?>

<div class="tab-content box box-info col-md-12">
<!-- <div id="master-1" class="tab-pane active">

<div class="box-header with-border master1-validation">
    <h3>Master 1</h3> -->
<div class="col-md-3 split-box">
<?php
  if(!$model->isNewRecord){
      $model->judgment_title       =  htmlspecialchars_decode($model->judgment_title);
      $model->court_name           =  htmlspecialchars_decode($model->court_name);
      $model->appellant_name       =  htmlspecialchars_decode($model->appellant_name);
      $model->appellant_adv        =  htmlspecialchars_decode($model->appellant_adv);
      $model->respondant_adv       =  htmlspecialchars_decode($model->respondant_adv);
      $model->judges_name          =  htmlspecialchars_decode($model->judges_name);
      $model->judgment_source_name =  htmlspecialchars_decode($model->judgment_source_name);

  }

 ?>

        <?php
        $courtMast             = ArrayHelper::map(CourtMast::find()->all(), 'court_code', 'court_name');
       /*  $courtMast = $cache->get('courtMast'); */ ?>
        <?= $form->field($model, 'court_name')->widget(Select2::classname(), [            
            'data' => $courtMast,

            'options' => ['placeholder' => 'Select Court', 'value' => (!$model->isNewRecord) ? $model->court_code : '', ],
            'pluginEvents'=>[
            "select2:select" => "function() { var val = $(this).val();                
              $('#judgmentmast-court_code').val(val);
                    $.ajax({
                      url      : '/cjadmin/judgment-mast/court?id='+val,
                      dataType : 'json',
                      success  : function(data) {                                 
                        $('#judgmentmast-hearing_place option').remove();
                        //$('#judgmentmast-hearing_place').append('<option>Select State</option>');
                        $.each(data, function(i, item){
                      $('#judgmentmast-hearing_place').append('<option value='+item.city_code+'>'+item.city_name+'</option>');
                      });
                          },
                      error: function(xhr, textStatus, errorThrown){
                           alert('No states for this contry');
                        }                                                         
                      });
             }"
            ]
            ]); ?>        
    <?= $form->field($model, 'court_code')->textInput(['readonly'=>true]) ?>


        <?=  $form->field($model, 'appeal_numb')->textInput() ?>

          <?php          
				$benchType    = ArrayHelper::map(JudgmentBenchType::find()->all(), 'bench_type_id', 'bench_type_text'); 
				$disposition  = ArrayHelper::map(JudgmentDisposition::find()->all(), 'disposition_id', 'disposition_text');
				$jurisdiction = ArrayHelper::map(JudgmentJurisdiction::find()->all(), 'judgment_jurisdiction_id', 'judgment_jurisdiction_text');

           ?>
             <?= $form->field($model, 'bench_type_id')->widget(Select2::classname(), [
          
          'data' => $benchType,
          //'language' => '',
          'options' => ['placeholder' => 'Select Judgment Bench Type'],
          'pluginEvents'=>[
            ]
          ]); ?>
          
                  <?= $form->field($model, 'disposition_id')->widget(Select2::classname(), [
          
          'data' => $disposition,
          //'language' => '',
          'options' => ['placeholder' => 'Select Judgment Disposition'],
          'pluginEvents'=>[
            ]
          ]); ?>
                  <?= $form->field($model, 'judgment_jurisdiction_id')->widget(Select2::classname(), [
          
          'data' => $jurisdiction,
          //'language' => '',
          'options' => ['placeholder' => 'Select judgment_jurisdiction'],
          'pluginEvents'=>[
            ]
          ]); ?>



    <?= $form->field($model, 'judgment_date')->widget(DateRangePicker::classname(), [
      'pluginOptions'=>[
          'singleDatePicker'=>true,
          'showDropdowns'=>true,
          'locale'=>['format' => 'YYYY-MM-DD'],
      ],
  ]);
    ?>
  <?= $form->field($model, 'jyear')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'appeal_status')->dropDownList(["1"=>'Active', "2"=>"Pending"]) ?>
  <?= $form->field($model, 'hearing_date')->widget(DateRangePicker::classname(), [
    'pluginOptions'=>[
        'singleDatePicker'=>true,
        'showDropdowns'=>true,
        'locale'=>['format' => 'YYYY-MM-DD'],
    ],
]);
  ?>

      <?php if(!$model->isNewRecord){
          if($model->hearing_place == '')
          {
            $hearing_place[] = '';
          }
          else
          {
               $citystate = CityMast::find()->select("state_code")->where(['city_code'=>$model->hearing_place])->one();
               $hearing_place = ArrayHelper::map(CityMast::find()->where(['state_code'=>$citystate->state_code])->all(), 'city_code', 'city_name'); 
          }
       }
        else{ $hearing_place[] = ''; }
       ?>

        <?= $form->field($model, 'hearing_place')->widget(Select2::classname(), [
          
          'data' => $hearing_place,
          //'language' => '',
          'options' => ['placeholder' => 'Select Hearing Place'],
          'pluginEvents'=>[
          "select2:select" => "function() { var val = $(this).val();                
           }"
            ]
          ]); ?>

      <?= $form->field($model, 'doc_id')->textInput(['maxlength' => true]) ?>
      
      <?= $form->field($model, 'judgment_source_name')->textInput(['maxlength' => true]) ?>

      <?= $form->field($model, 'judgment_type')->dropDownList(["0"=>'Order', "1"=>"Oral Order","2"=>"Judgment"],['prompt'=>'Select Appeal Status']) ?>


     <?php  //$jcatg_description = $cache->get('jcatg_description');
     //if(empty($cache->get('jcatg_description'))){
     $jcatg_description = ArrayHelper::map(JcatgMast::find()->all(), 'jcatg_id', 'jcatg_description');
      //$jcatg_description = $cache->get('jcatg_description');
     
      ?>
    
    <?= $form->field($model, 'jcatg_description')->widget(Select2::classname(), [
            
            'data' => $jcatg_description,           
            //'language' => '',
            'options' => ['placeholder' => 'Select Judgment Category','value' => ($model->jcatg_id != "") ? $model->jcatg_id : ''],
  		'pluginEvents'=>[
            "select2:select" => "function() { var val = $(this).val();                
              $('#judgmentmast-jcatg_id').val(val);
                    $.ajax({
                      url      : '/cjadmin/judgment-mast/jsubcateg?id='+val,
                      dataType : 'json',
                      success  : function(data) {                                 

                        //$('#judgmentmast-jsub_catg_description').remove();                        
                       $('#judgmentmast-jsub_catg_description').empty(); 		
                       $('#judgmentmast-jsub_catg_description').append('<option>Select Sub Category</option>');
                        $.each(data, function(i, item){


                      $('#judgmentmast-jsub_catg_description').append('<option value='+item.jsub_catg_id+'>'+item.jsub_catg_description+'</option>');
                      });
                          },
                      error: function(xhr, textStatus, errorThrown){
                           alert('No Judgment Sub Category found');
                        }                                                         
                      });
             }"
            ]

             ]); ?>

      <?= $form->field($model, 'jcatg_id')->textInput(['readonly'=>true]) ?>

      <?php  //$jsub_catg_description = $cache->get('jsub_catg_description');
      $jsub_catg_description = ($model->jsub_catg_id != "") ?  ArrayHelper::map(JsubCatgMast::find()->where(["jsub_catg_id"=>$model->jsub_catg_id])->all(), 'jsub_catg_id', 'jsub_catg_description') : "" ; ?>
    
      <?= $form->field($model, 'jsub_catg_description')->dropDownList([
      	'data' => $jsub_catg_description,
      	'prompt' => 'Select sub category'
      	]);
      /*->widget(Select2::classname(), [
            
            'data' => $jsub_catg_description,
            //'language' => '',
            'options' => ['placeholder' => 'Select Judgment Category','value' => (!$model->isNewRecord) ? $model->jsub_catg_id : ''],
            'pluginEvents'=>[
            "select2:select" => "function() { var val = $(this).val();
        $('#judgmentmast-jsub_catg_id').val(val);                
             }"
              ]
            ]);*/ ?>

      <?= $form->field($model, 'jsub_catg_id')->textInput(['readonly'=>true]) ?>

      <?= $form->field($model, 'judgment_ext_remark_flag')->dropDownList(["0"=>'Yes', "1"=>"No"],['prompt'=>'Select Remark Flag']) ?>
   </div>

   <div class="col-md-9 split-box">

    <?= $form->field($model, 'judgment_title')->textInput(['maxlength' => true]) ?>

  <?php 
/*
     if(!$model->isNewRecord)
    {
        $model->appellant_name = explode(';', $model->appellant_name); 
        $appellant_name = '';
        foreach ($model->appellant_name as $key => $value) {
            $appellant_name[$value] = $value;
        }
    }
    else{
        $appellant_name[] ='';
    }*/
    ?>    
    <?=  $form->field($model, 'appellant_name')->textInput() 
    /*w    idget(Select2::classname(), [
              'data' => $appellant_name,
              'options' => ['placeholder' => 'Select Appellant Name ...', 'multiple' => true, "class"=>"form-data"],
              'pluginOptions' => [
                  'tags' => true,
                  'tokenSeparators' => [';'],
                  'maximumInputLength' => 1000,
                  'maintainOrder'=>true 
              ],
          ]);   */

       ?>
          <?php 
   /*      if(!$model->isNewRecord)
        {
            $model->respondant_name = explode(';', $model->respondant_name); 
            $respondant_name = '';
            foreach ($model->respondant_name as $key => $value) {
                $respondant_name[$value] = $value;
            }


        }
        else{
            $respondant_name[] = '';
        }*/
    ?>    

        <?=  $form->field($model, 'respondant_name')->textInput()


        /*->widget(Select2::classname(), [
              'data' => $respondant_name,
              'options' => ['placeholder' => 'Select Name ...', 'multiple' => true, "class"=>"form-data"],
              'pluginOptions' => [
                  'tags' => true,
                  'tokenSeparators' => [';'],
                  'maximumInputLength' => 1000,
                  'maintainOrder'=>true 
              ],
 
          ]);*/    ?>
            

      <?php 

        /* if(!$model->isNewRecord)
          {
              $model->appellant_adv = explode(';', $model->appellant_adv); 
              $appellant_adv = '';
              foreach($model->appellant_adv as $key => $value) {
                  $appellant_adv[$value] = $value;
              }
          }
        else{
            $appellant_adv = [];
        }*/
    ?>    

        <?php /*  $form->field($model, 'appellant_adv')->widget(Select2::classname(), [
              'data' => $appellant_adv,
              'options' => ['placeholder' => 'Select Type ...', 'multiple' => true, "class"=>"form-data"],
              'pluginOptions' => [
                  'tags' => true,
                  'tokenSeparators' => [';'],
                  'maximumInputLength' => 1000,
                  'maintainOrder'=>true 
              ],
              'pluginEvents' => [         
               "select2:close" => "function() { console.log('close'); }",           
          ]
        ]);   */ ?>
      
      <?= $form->field($model, 'appellant_adv')->textInput() ?>

      <?= $form->field($model, 'appellant_adv_count')->textInput(['readonly'=>true]) ?>
      <?php 

      /*   if(!$model->isNewRecord)
        {
            $model->respondant_adv = explode(';', $model->respondant_adv); 
            $respondant_adv = '';
            foreach ($model->respondant_adv as $key => $value) {
                $respondant_adv[$value] = $value;
            }
        }
        else{
            $respondant_adv[] = '';
        }*/
    ?>    
        <?=  $form->field($model, 'respondant_adv')->textInput() 
        /*widget(Select2::classname(), [
              'data' => $respondant_adv,
              'options' => ['placeholder' => 'Select Type ...', 'multiple' => true, "class"=>"form-data"],
              'pluginOptions' => [
                  'tags' => true,
                  'tokenSeparators' => [','],
                  'maximumInputLength' => 1000,
                  'maintainOrder'=>true 
              ],
              'pluginEvents' => [   
              "select2:select" => "function() {  var count = $(this).find('option').length;   $('#judgmentmast-respondant_adv_count').val(count); }",
          ]
          ]);*/    ?>

        <?= $form->field($model, 'respondant_adv_count')->textInput(['readonly'=>true]) ?>

          <?php 

     /*    if(!$model->isNewRecord)
        {
            $model->citation = explode(';', $model->citation); 
            $citation = '';
            foreach ($model->citation as $key => $value) {
                $citation[$value] = $value;
            }


        }
        else{
            $citation[] = '';
        }*/
    ?>    

        <?=  $form->field($model, 'citation')->textInput() 

        /*->widget(Select2::classname(), [
              'data' => $citation,
              'options' => ['placeholder' => 'Select Type ...', 'multiple' => true, "class"=>"form-data"],
              'pluginOptions' => [
                  'tags' => true,
                  'tokenSeparators' => [','],
                  'maximumInputLength' => 1000,
                  'maintainOrder'=>true 
              ],
              'pluginEvents' => [
               
                "select2:select" => "function() {  var count = $(this).find('option').length;   $('#judgmentmast-citation_count').val(count); }",               
          ]
          ]);*/    ?>
    <?= $form->field($model, 'citation_count')->textInput(['readonly'=>true]) ?>

   <?php 
         /*if(!$model->isNewRecord)
        {
            $model->judges_name = explode(';', $model->judges_name); 
            $judges_name = '';
            foreach ($model->judges_name as $key => $value) {
                $judges_name[$value] = $value;
            }
        }
        else{
            $judges_name[] = '';
        }*/
    ?>    

        <?=  $form->field($model, 'judges_name')->textInput() 
        /*widget(Select2::classname(), [
              'data' => $judges_name,
              'options' => ['placeholder' => 'Select Type ...', 'multiple' => true, "class"=>"form-data"],
              'pluginOptions' => [
                  'tags' => true,
                  'tokenSeparators' => [','],
                  'maximumInputLength' => 1000,
                  'maintainOrder'=>true 
              ],
              'pluginEvents' => [   
              "select2:select" => "function() {  var count = $(this).find('option').length;   
              $('#judgmentmast-judges_count').val(count); }",
             
          ]
          ]);*/    ?>

	      <?= $form->field($model, 'judges_count')->textInput(['readonly'=>true]) ?>

			<?= $form->field($model, 'judgment_abstract')->textarea(['rows' => 6]) ?>
			
			<?= $form->field($model, 'judgment_text')->textarea(['rows' => 6]) ?>


    <?php  /*$judgmentMast =  ArrayHelper::map(JudgmentMast::find()->select('judgment_code,judgment_title,judgment_title')->all(), 'judgment_code',
    function($result) {
        return $result['court_name'].'::'.$result['judgment_title'];
    });*/ ?>
    
    <?php   /*$form->field($model, 'overrule_judgment')->widget(Select2::classname(), [
            
            'data' => $judgmentMast,
            //'language' => '',
            'options' => ['placeholder' => 'Select Judgment Category'],
            'pluginEvents'=>[
            "select2:select" => "function() { var val = $(this).val();                
             }"
              ]
            ]);*/ ?>

        <?php /* $form->field($model, 'overruled_by_judgment')->widget(Select2::classname(), [            
            'data' => $judgmentMast,
            'options' => ['placeholder' => 'Select Judgment Category'],
            'pluginEvents'=>[
            "select2:select" => "function() { var val = $(this).val();                
             }"
              ]
            ]);*/ ?>
</div>            

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success pull-left' : 'btn btn-primary pull-left ']) ?>
    </div>
</div>
 <?php ActiveForm::end(); ?>


</div>


  
   
<script type="text/javascript">
function master1()
{
	var court_code = $('#judgmentmast-court_code').val();
	var court_name = $('#judgmentmast-court_name').val();
	var appeal_numb = $('#judgmentmast-appeal_numb').val();
	var judgment_date = $('#judgmentmast-judgment_date').val();
	var judgment_title = $('#judgmentmast-judgment_title').val();
	var appellant_adv_count = $('#judgmentmast-appellant_adv_count').val();
	var respondant_adv_count = $('#judgmentmast-respondant_adv_count').val();
	var appeal_status = $('#judgmentmast-appeal_status').val();
	var citation = $('#judgmentmast-citation').val();
	var citation_count = $('#judgmentmast-citation_count').val();
	var judges_name = $('#judgmentmast-judges_name').val();
	var judges_count = $('#judgmentmast-judges_count').val();
	if(code == '')
	{
		$('.field-judgmentmast-court_code').addClass('has-error');
		$('#judgmentmast-court_code').focus();		
	}
	else{		
		$('.field-judgmentmast-court_name').addClass('has-error');
		$('#judgmentmast-court_code').focus();
		
	}

}
/*	if($('.master1-validation').find('class','has-error'))
{
	
	$('.has-error').closest('input').focus();

}
else{
	$('.nav-pills li').removeClass('active');
	$('.master2').addClass('active');	
	$(this).attr('href','#master-2');
}*/

</script>    

<?php 

 ?>
<?php 
    $this->registerJs("CKEDITOR.replace('judgmentmast-judgment_abstract',{toolbar : 'Basic'})");

?>
<?php 
    $this->registerJs("CKEDITOR.replace('judgmentmast-judgment_text',{toolbar : 'Basic'})");

?>
<?php

$this->registerJs("$('#judgmentmast-jyear').datepicker({
   format: 'yyyy', // Notice the Extra space at the beginning
    viewMode: 'years', 
    minViewMode: 'years',
    autoclose: true,
});");
 ?>
 <?php

$this->registerJs("$('#judgmentmast-appellant_adv').keyup(function(e){
    var count = $(this).val().split(';').length;
  
    $('#judgmentmast-appellant_adv_count').val(count);
    });
	$('#judgmentmast-respondant_adv').keyup(function(e){
    var count = $(this).val().split(';').length;
    $('#judgmentmast-respondant_adv_count').val(count);
    });
    $('#judgmentmast-citation').keyup(function(e){
    var count = $(this).val().split(';').length;
    $('#judgmentmast-citation_count').val(count);
    });
    $('#judgmentmast-judges_name').keyup(function(e){
    var count = $(this).val().split(';').length;
    $('#judgmentmast-judges_count').val(count);
    });

   /* $('#judgmentmast-appellant_adv').keydown(function(e){
   var appadv = $(this).val();
    var count = $(this).val().split(';').length;
    var trim1 = $.trim($('#judgmentmast-appellant_adv').val());
    $('#judgmentmast-appellant_adv').val(trim1);

    });
  $('#judgmentmast-respondant_adv').keydown(function(e){

   var appadv = $(this).val();
    var count = $(this).val().split(';').length;
    var trim1 = $.trim($('#judgmentmast-respondant_adv').val());
    $('#judgmentmast-respondant_adv').val(trim1);
    });
    $('#judgmentmast-citation').keydown(function(e){
   var appadv = $(this).val();
    var count = $(this).val().split(';').length;
    var trim1 = $.trim($('#judgmentmast-citation').val());
    $('#judgmentmast-citation').val(trim1);
    });
    $('#judgmentmast-judges_name').keydown(function(e){
    var count = $(this).val().split(';').length;
    var trim1 = $.trim($('#judgmentmast-judges_name').val());
    $('#judgmentmast-judges_name').val(trim1);
    });
    $('#judgmentmast-appeal_numb').keydown(function(e){
    var count = $(this).val().split(';').length;
    var trim1 = $.trim($('#judgmentmast-appeal_numb').val());
    $('#judgmentmast-appeal_numb').val(trim1);
    });
      $('#judgmentmast-appellant_name').keydown(function(e){
    var count = $(this).val().split(';').length;
    var trim1 = $.trim($('#judgmentmast-appellant_name').val());
    $('#judgmentmast-appellant_name').val(trim1);
    });
       $('#judgmentmast-respondant_name').keydown(function(e){
    var count = $(this).val().split(';').length;
    var trim1 = $.trim($('#judgmentmast-respondant_name').val());
    $('#judgmentmast-respondant_name').val(trim1);
    });*/

$('#judgmentmast-jsub_catg_description').select(function() {
  alert( $(this).val());
});

    ");
 ?>
<style type="text/css">
  .split-box{
    padding:45px;
  }
  .split-box{
    border-style: outset;
  }
</style>
<?php $customScript = <<< SCRIPT
	$('#judgmentmast-jsub_catg_description').on("change", function(){
		var jdes = $(this).val();
  	$('#judgmentmast-jsub_catg_id').empty();
  	$('#judgmentmast-jsub_catg_id').val(jdes);

});
SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY); ?>



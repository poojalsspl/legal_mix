<?php

use yii\widgets\ActiveForm;
use frontend\models\Dictionary;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
?>


<div class="dictionary-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container">
    	<div class="row">
    		<div class="col-md-3"></div>
    		<div class="col-md-6">
    <?php $dictionary = ArrayHelper::map(Dictionary::find()->all(),'id','word');?>
    <?= $form->field($model, 'id')->widget(Select2::classname(), [
          'data' => $dictionary,
          'options' => ['placeholder' => 'Select Word'],
          'pluginEvents'=>[
            ]
          ])->label('Word'); ?>
          </div>
          <div class="col-md-3"></div>
      </div>
          <div class="row">
          	<div class="col-md-3"></div>
    		<div class="col-md-6">
     <?= $form->field($model, 'synonym')->textInput(['readonly'=> true]) ?>     
     <?= $form->field($model, 'defination')->textarea(['rows' => 6,'readonly'=> true]) ?>
        </div>
          <div class="col-md-3"></div>
    </div>  
     </div>
    

     <?php ActiveForm::end(); ?>  
</div>
<?php $customScript = <<< SCRIPT


$('#dictionary-id').on('change', function(){
    var dictionary = $(this).val();

 if(dictionary=='')
 {
    alert('Please Select Word');
 }
 else
$.ajax({
//type     :'GET',
url        : '/dictionary/wordsearch?id='+dictionary,
dataType   : 'json',
success    : function(data){

console.log(typeof data);
 data.forEach(function(e){
//console.log('e',e)

synonym = e.synonym;
defination = e.defination;
});

$('#dictionary-synonym').val(synonym);
$('#dictionary-defination').val(defination);

},
});

}); 

SCRIPT;
$this->registerJs($customScript, \yii\web\View::POS_READY);?>        
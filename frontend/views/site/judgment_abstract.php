<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div>
	<?php 
   $jcode = $_GET['jcode'];
   $doc_id = $_GET['doc_id'];

   $status = ['Public'=>'Public','Private'=>'Private'];

	?>
	<h2>Any suggestion for the judgment abstract or judgment headnote</h2>
 <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

 <?= $form->field($model, 'judgment_abstract')->textArea(['placeholder' => 'Enter Judgment Abstract','rows'=>6]) ?>
 <?= $form->field($model, 'abstract_status')->dropDownList($status,['prompt'=>'Select Status']); ?>
 <div class="col-md-4 col-md-offset-4">
 	<?= Html::submitButton('Submit', ['class' => 'btn-block btn theme-blue-button ']) ?>
 </div>

 <?php ActiveForm::end(); ?>
</div>
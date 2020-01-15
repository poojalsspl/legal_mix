<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\JudgmentMast;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentExtRemark */
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

$judgment =ArrayHelper::map(JudgmentMast::find()->where(['judgment_code'=>$jcode])->all(),
    'judgment_code',
    function($result) {
        return $result['court_name'].'::'.$result['judgment_title'];
    });
    

?>

<div class="judgment-ext-remark-form">

    <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'judgment_code')->widget(Select2::classname(), [
    'data' => $judgment,
    'disabled'=>true,
    'initValueText' => $jcode,    
    //'language' => '',
    'options' => ['placeholder' => 'Select Judgment Code','value'=>$jcode],

]); ?>


    <?= $form->field($model, 'judgment_remark')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>        
<?php if($jcount != '' && $jyear != ''){ ?>

        <?= Html::a('Next', ['next-page','jcode'=>$jcode,"jcount"=>$jcount,'jyear'=>$jyear],['class' =>  'btn btn-danger pull-right']) ?>
<?php } ?>
 <?php if(!$model->isNewRecord) { ?>
 <?= Html::a('Delete', ['judgment-ext-remark/deleteall', 'jcode' => $jcode], ['class' => 'btn btn-danger pull-right']) ?>
 <?php } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php 
    $this->registerJs("CKEDITOR.replace('judgmentextremark-judgment_remark')");

?>

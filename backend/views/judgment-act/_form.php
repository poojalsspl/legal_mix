<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\JudgmentMast;
use backend\models\BareactCatg;
use backend\models\BareactMast;
use backend\models\BareactDetail;
use backend\models\CountryMast;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;



/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentAct */
/* @var $form yii\widgets\ActiveForm */
    $jcode  = '';
    $jcount = '';
    $jyear  = '';
if($_GET)
{
 $jcode = $_GET['jcode'];
//    exit();
    $jcount = $_GET['jcount'];
    $jyear = $_GET['jyear'];
}

$judgment = ArrayHelper::map(JudgmentMast::find()->where(['judgment_code'=>$jcode])->all(),
    'judgment_code',
    function($result) {
        return $result['court_name'].'::'.$result['judgment_title'];
    });
//$bareactCatg = ArrayHelper::map(BareactCatg::find()->all(), 'bareact_catgid', 'bareact_catg_name');
//$bareactMast = ArrayHelper::map(BareactMast::find()->all(), 'bareact_id', 'act_name');
//$bareactDetail = ArrayHelper::map(BareactDetail::find()->all(), 'catg_id', 'catg_title');
$countryMast = ArrayHelper::map(CountryMast::find()->all(), 'country_code', 'country_name');

?>

<div class="judgment-act-form">

    <?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'judgment_code')->widget(Select2::classname(), [
    'data' => $judgment,
    'disabled'=>true,
    'initValueText' => $jcode,     
    //'language' => '',
    'options' => ['placeholder' => 'Select Judgment Code','value'=>$jcode],

]); ?>
    <?php /* $form->field($model, 'bareact_catg_name')->dropDownList($bareactCatg, ['prompt' => 'Select Category', "onchange"=>"
                                                    var code = $(this).val();
                                                    $('#judgmentact-bareact_catgid').val(code);"]) */?>
    <?php /* $form->field($model, 'bareact_catgid')->textInput(['readonly'=>true]) */?>

    <?php /* $form->field($model, 'act_name')->dropDownList($bareactMast, ['prompt' => 'Select Act Name',"onchange"=>"
                                                    var code = $(this).val();
                                                    $('#judgmentact-bareact_id').val(code);"]) */?>



    <?php /* $form->field($model, 'bareact_id')->textInput(['readonly'=>true]) */?>

    <?php /*$form->field($model, 'catg_title')->dropDownList($bareactDetail, ['prompt' => 'Select Act Name',"onchange"=>"
                                                    var code = $(this).val();
                                                    $('#judgmentact-catg_id').val(code);"]) */?>

   
   

    <?php /* $form->field($model, 'catg_id')->textInput(['readonly'=>true]) */?>

    <?php /*$form->field($model, 'country_name')->dropDownList($countryMast, ['prompt' => 'Select Act Name',"onchange"=>"
                                                    var code = $(this).val();
                                                    $('#judgmentact-country_code').val(code);"]) */?>

  

      <?= $form->field($model, 'country_code')->textInput(['readonly'=>true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php if(!$model->isNewRecord) { ?>
         <?= Html::a('Delete All', ['judgment-act/deleteall', 'jcode' => $jcode], ['class' => 'btn btn-danger pull-right']) ?>
 <?php } ?> 
    </div>
<?php if($jcount != '' && $jyear != ''){ ?>

        <?= Html::a('Next', ['next-page','jcode'=>$jcode,"jcount"=>$jcount,'jyear'=>$jyear],['class' =>  'btn btn-danger pull-right']) ?>
<?php } ?>
    <?php ActiveForm::end(); ?>

</div>


<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\JudgmentParties;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentParties */

$this->title = $model->judgment_party_id;
$this->params['breadcrumbs'][] = ['label' => 'Judgment Parties', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-parties-view">
        <h1>Appellant-Respondent</h1>

    <h1></h1>

    <p>
    </p>
    <?php $advocate = JudgmentParties::find()->where(['judgment_code'=>$model->judgment_code])->all();    ?>

        <div class="dynamic-rows rows col-xs-12">


        <?php foreach ($advocate as $adv) {
            $flag = ($adv->party_flag == '1' ? 'selected' : $adv->party_flag == '2'  ? 'selected' : '' );             
                
        ?>
                 <div class="dynamic-rows-field row" data-id="<?= $adv->judgment_party_id ?>"><div class="col-xs-4"><div class="form-group field-judgmentparties-party_flag has-success"><label class="control-label" for="judgmentparties-party_flag">Party Flag</label><select id="judgmentparties-party_flag" class="form-control" name="JudgmentParties[party_flag][]" aria-invalid="false" readonly><option value="1" <?= ($adv->party_flag == '1' ? 'slected' : '') ?>>Appellant</option><option value="2" <?= ($adv->party_flag == '2' ? 'slected' : '') ?>>Respondent</option><option value="3" <?= ($adv->party_flag == '3' ? 'slected' : '') ?>>intervener</option></select><div class="help-block"></div></div></div><div class="col-xs-6"><div class="form-group field-judgmentparties-party_name has-success"><label class="control-label" for="judgmentparties-party_name">Party Name</label><input type="text" id="judgmentparties-party_name" class="form-control judgmentparties-party_name" name="JudgmentParties[party_name][]" maxlength="50" aria-invalid="false" value="<?= $adv->party_name ?>" readonly><div class="help-block"></div></div></div>
         <div class="col-xs-2" style="margin-top:25px;">
    <?= Html::a('<span class="glyphicon glyphicon-trash"> Delete </span>', ['delete-one', 'id'=>$adv->judgment_party_id],['data-confirm' => Yii::t('yii', 'Are you sure you want to Delete selected items?'),  'class' => 'btn btn-block btn-danger btn-xs']); ?>
    </div>
         </div>
    <?php } ?>


    </div>
    <?php /*DetailView::widget([
        'model' => $model,
        'attributes' => [
            'judgment_party_id',
            'judgment_code',
            'party_name',
            'party_flag',
        ],
    ])*/ ?>

</div>

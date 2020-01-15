<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\JudgmentAdvocate;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentAdvocate */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Judgment Advocates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-advocate-view">

    <h1>Judgment Advocates</h1>

    <p>
        <?php /* Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary'])*/ ?>
        <?php /*Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])*/ ?>
    </p>

    <?php /*DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'judgment_code.court',
            'judgment_code.title',
            'advocate_name',
            'advocate_flag',
        ],
    ])*/ ?>

    <?php $advocate = JudgmentAdvocate::find()->where(['judgment_code'=>$model->judgment_code])->all();    ?>
   <?php if(!$model->isNewRecord) { ?>   

			<div class="box-header with-border"><h3 class="box-title">Advocate</h3></div>




	<?php $advocate = JudgmentAdvocate::find()->where(['judgment_code'=>$model->judgment_code])->all();    ?>

	<div class="dynamic-rows rows col-xs-12">


		<?php foreach ($advocate as $adv) {
			$flag = ($adv->advocate_flag == '1' ? 'selected' : $adv->advocate_flag == '2'  ? 'selected' : '' );  			
				
		?>

	
	<div class="dynamic-rows-field row" data-id="<?= $adv->id ?>"><div class="col-xs-4"><div class="form-group field-judgmentadvocate-advocate_flag has-success"><label class="control-label" for="judgmentadvocate-advocate_flag">Advocate Flag</label><select id="judgmentadvocate-advocate_flag" class="form-control" name="JudgmentAdvocate[advocate_flag][]" aria-invalid="false" readonly ><option value="1" <?= ($adv->advocate_flag == '1' ? 'slected' : '') ?> >Appellant</option><option value="2" <?= ($adv->advocate_flag == '2' ? 'selected' : '') ?> >Respondent</option><option value="3" slected = "<?= ($adv->advocate_flag == '3' ? 'selected' : '') ?>">intervener</option></select><div class="help-block"></div></div></div><div class="col-xs-6"><div class="form-group field-judgmentadvocate-advocate_name has-success"><label class="control-label" for="judgmentadvocate-advocate_name">Advocate Name</label><input type="text" id="judgmentadvocate-advocate_name" class="form-control judgmentadvocate-advocate_name" name="JudgmentAdvocate[advocate_name][]" readonly maxlength="50" aria-invalid="false" value="<?= $adv->advocate_name ?>"><div class="help-block"></div></div>

	<input type="hidden" name="JudgmentAdvocate[id][]" value="<?= $adv->id ?>">
	</div>
    <div class="col-xs-2" style="margin-top:25px;">
    <?= Html::a('<span class="glyphicon glyphicon-trash"> Delete </span>', ['delete-one', 'id'=>$adv->id],['data-confirm' => Yii::t('yii', 'Are you sure you want to Delete selected items?'),  'class' => 'btn btn-block btn-danger btn-xs']); ?>
    </div>

    </div>
	<?php } ?>


	</div>
	<div class="row form-group">
    <div class="col-xs-4">

    </div>
    <div class="col-xs-8">

    </div>
    </div>
    <?php } ?>


    </div>


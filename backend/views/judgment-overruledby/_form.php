<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\JudgmentMast;
use backend\models\JudgmentOverruledby;
use backend\models\JudgmentMastSearch;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentOverrules */
/* @var $form yii\widgets\ActiveForm */
?>

<?php

    $jcode  = '';
    $jcount = '';
    $jyear  = '';
if($_GET)
{
    $jcode  = $_GET['jcode'];
    $jcount = $_GET['jcount'];
    $jyear  = $_GET['jyear'];
}


 ?>



<?php

    $searchModel       = new JudgmentMastSearch();
    $dataProvider      = $searchModel->search(Yii::$app->request->queryParams);
    //$jcode             = 1; 
    $judegmentCode     = $jcode;
    $JudgmentOverruledBy = JudgmentOverruledby::find()->where(['judgment_code'=>$judegmentCode])->all();
//if(count($judgmentOverrules)>0){
 ?>
<?php if($jcount=="") 
{
 echo  Html::a('Update', ['judgment-mast/judgmentupdate',"code"=>$judegmentCode],['class' =>  'btn btn-info pull-right position-check']); 	
}
 else { echo Html::a('Next', ['next-page'],['class' =>  'btn btn-danger pull-right position-check']); } ?>
<div class="judgment-mast-index tab-content box box-info col-md-12"> 
<table class="table table-bordered table-inverse">
  <thead>
    <tr>
      <th>#</th>
      <th>Judgment Code</th>
      <th>Over RuledBy Code</th>
      <th>Over RuledBy Title</th>
      <th>  <?= Html::a('Delete All', ['deleteall','jcode'=>$judegmentCode],['class' =>  'btn btn-danger btn-md pull-right']) ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($JudgmentOverruledBy as $JudgmentOverruledBySingle) { ?>
    <tr>
      <th scope="row"><?= $JudgmentOverruledBySingle->id ?></th>
      <td><?= $JudgmentOverruledBySingle->judgment_code ?></td>
      <td><?= $JudgmentOverruledBySingle->over_ruledby_code ?></td>
      <td><?= $JudgmentOverruledBySingle->over_ruledby_title ?></td>
      <td><?= Html::a('<span class="glyphicon glyphicon-trash"></span>', ['singledelete','id'=>$JudgmentOverruledBySingle->id,'jyear'=>$jyear,'jcode'=>$jcode],['class' => 'btn btn-block btn-danger btn-xs']) ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>



  <?php //} ?>

<?php Pjax::begin(); ?>    
<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,

        'columns' => [
            'judgment_code',   
            'court_name',
            'judgment_date',
            'jyear',
            'judgment_title',
            ['class' => 'yii\grid\ActionColumn',
            'header'=>'Actions',
            'template' => '{Add}', 
            'buttons' => [
                'Add' => function ($url, $model, $key) use ($judegmentCode) {
                    return Html::a('<span class="glyphicon glyphicon-plus"></span>', ['adddata','id'=>$model->judgment_code,'jcode'=>$judegmentCode],['class' => 'btn btn-block btn-primary btn-xs add-data']);
                },
                'format' => 'raw',
              ],
            'contentOptions' => [ "class"=>'action-btns', 'width'=>''],
        ],
      ],
    ]); ?>
<?php Pjax::end(); ?>


</div>

<style type="text/css">
.position-check
{
    margin: -38px 25px 26px 16px;
}
	    
</style>






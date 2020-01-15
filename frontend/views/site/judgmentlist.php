<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\data\ActiveDataProvider;
use app\models\UserMast;
use backend\models\JudgmentMast;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */
?>
  <?php $form = ActiveForm::begin(); 
    $baseUrl =   \Yii::$app->request->BaseUrl;
    //exit;
  ?>
 <h1><?= Html::encode($this->title) ?></h1>
   <div class="row" style="margin-top: 50px">
        <div class="col-lg-10">
          <div class="table-responsive">
 <?= GridView::widget([
    'dataProvider' => $jmast,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',
         'contentOptions'=>[ 'style'=>'width: 50px'], ],
        [
           
            'label' =>"Appellant Name",
            'attribute' => 'appellant_name',
             'contentOptions'=>[ 'style'=>'width: 100px'],
        ],
        [
            'label' =>"Judgement Title",
            'attribute' => 'judgment_title',
             'contentOptions'=>[ 'style'=>'width: 150px'],
        ],
        [
            'label' =>"Judgement Date",
            'attribute' => 'judgment_date',
             'contentOptions'=>[ 'style'=>'width: 50px'],
        ],
          [
        'contentOptions'=>[ 'style'=>'width: 50px'],
        'class' => 'yii\grid\ActionColumn',
        'template' => '{view}',
        'buttons' => ['view' => function($url, $model) {
         return Html::a('<span class="btn btn-sm btn-default"><b class="fa fa-search-plus"></b></span>', ['site/judgment'.'/' . $model['judgment_code']], ['title' => 'View', 'judgment_code' => 'modal-btn-view']);
  },
 
 
    ]
],
        
    ],
]);
?>
</div>
</div>
    <?php ActiveForm::end(); ?>
</div>
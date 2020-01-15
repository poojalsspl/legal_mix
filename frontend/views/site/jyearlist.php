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

        <div class="col-lg-8">
 <?= GridView::widget([
    'dataProvider' => $jmast,
    'tableOptions' => [
    'class' => 'table table-striped',
],
'options' => [
    'class' => 'table-responsive',
],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn',
         'contentOptions'=>[ 'style'=>'width: 50px'], ],
         [
            'label' =>"Court code",
            'attribute' => 'court_code',
             'contentOptions'=>[ 'style'=>'width: 50px'],
        ],
        [
            'label' =>"Name",
            'attribute' => 'court_name',
             'contentOptions'=>[ 'style'=>'width: 150px'],
        ],
        [
            'label' =>"Year",
            'attribute' => 'jyear',
             'contentOptions'=>[ 'style'=>'width: 50px'],
        ],
        [
            'label' =>"Cases",
            'attribute' => 'cases',
             'contentOptions'=>[ 'style'=>'width: 50px'],
        ],
       [
        'contentOptions'=>[ 'style'=>'width: 50px'],
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}',
    'buttons' => ['view' => function($url, $model) {
      return Html::a('<span class="btn btn-sm btn-default"><b class="fa fa-search-plus"></b></span>', ['judgmentlist', 'jyear' => $model['jyear'],'court_code' => $model['court_code']], ['title' => 'View', 'jyear' => 'modal-btn-view']);
  },
  ]
  ],
  ],
]);
?>
</div>

    <?php ActiveForm::end(); ?>
</div>
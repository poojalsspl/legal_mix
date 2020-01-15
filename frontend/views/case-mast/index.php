<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\CaseMastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Case Master';
$this->params['breadcrumbs'][] = $this->title;
?>  
<div class="container">
<div class="table-responsive">
<div class="case-mast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create New Case', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           [
            'attribute' => 'custid',
            'value' => 'customer.custname',
           ],
            //'case_type_id',
            //'case_reg_date',
            //'case_over_date',
            //'appeal_number',
            //'court_code',
            //'appellant_name',
            //'respondant_name',
            //'case_summary:ntext',
            'case_desc',
             [
                    'attribute'=>'',
                    'format'=>'raw',
                    'value' => function($dataProvider)
                    {
                        return
                        Html::a("Case details", ['case-detl/index','id'=>  $dataProvider->Id], ['title' => 'View','class'=>'yii\grid\ActionColumn']);
                    }
            ],
            //'case_fees',
            //'case_status',

            ['class' => 'yii\grid\ActionColumn'],
        ]
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
</div>

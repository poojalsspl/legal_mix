<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\CustMast;
/* @var $this yii\web\View */
/* @var $searchModel app\models\InvcMastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice Masters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php // Html::a('Create Invoice', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'invc_numb',
            'invc_date',
            [
              'attribute' => 'custid',
              'value' => 'customerName.custname',
            ],
            'invc_amt',
            //'GST',
            //'invc_disc',
            [
                    'attribute'=>'Create Receipt',
                    'format'=>'raw',
                    'value' => function($dataProvider)
                    {
                        return
                        Html::a("Receipt", ['receipt/create','custid'=>  $dataProvider->custid], ['title' => 'View','class'=>'yii\grid\ActionColumn']);
                    }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

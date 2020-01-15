<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PlanMastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Plan Masts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-mast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Plan Mast', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'plan_code',
            'plan_name',
            'plan_expiry',
            'plan_rate',
            'coupon_allowed',
            //'plan_desc:ntext',
            //'search_limit',
            //'access_limit',
            //'access_rate_limit',
            //'concurrent_connection',
            //'plan_taxed',
            //'static_ip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

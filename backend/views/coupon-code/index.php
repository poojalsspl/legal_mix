<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CouponCodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Coupon Codes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="coupon-code-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Coupon Code', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'coupon_id',
            'rand_code',
            'gen_date',
            'exp_date',
            'use_limit',
            // 'used',
            // 'discount_type',
            // 'discount_val',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PlanMast */

$this->title = $model->plan_code;
$this->params['breadcrumbs'][] = ['label' => 'Plan Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-mast-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->plan_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->plan_code], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'plan_code',
            'plan_name',
            'plan_expiry',
            'plan_rate',
            'coupon_allowed',
            'plan_desc:ntext',
            'search_limit',
            'access_limit',
            'access_rate_limit',
            'concurrent_connection',
            'plan_taxed',
            'static_ip',
        ],
    ]) ?>

</div>

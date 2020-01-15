<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\StateMast */

$this->title = $model->state_code;
$this->params['breadcrumbs'][] = ['label' => 'State Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-mast-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->state_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->state_code], [
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
            'country_name',
            'country_shrt_name',
            'country_code',
            'state_code',
            'state_name',
            'shrt_name',
            'zone',
            'cr_date',
            'status',
        ],
    ]) ?>

</div>

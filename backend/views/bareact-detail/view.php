<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BareactDetail */

$this->title = $model->catg_id;
$this->params['breadcrumbs'][] = ['label' => 'Bareact Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bareact-detail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->catg_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->catg_id], [
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
            'catg_id',
            'bareact_id',
            'source_catg_id',
            'old_catg_id',
            'catg_type',
            'catg_title',
            'Enactment_date',
            'catg_text:ntext',
        ],
    ]) ?>

</div>

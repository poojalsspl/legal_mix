<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\BareactMast */

$this->title = $model->bareact_id;
$this->params['breadcrumbs'][] = ['label' => 'Bareact Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bareact-mast-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bareact_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bareact_id], [
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
            'bareact_id',
            'old_bareact_id',
            'source_act_id',
            'act_name',
            'bareact_catgid',
            'bareact_catg_name',
            'tot_section',
            'tot_chap',
            'Enactment_date',
            'bareact_text:ntext',
        ],
    ]) ?>

</div>

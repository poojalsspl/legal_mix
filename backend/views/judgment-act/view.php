<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentAct */

$this->title = $model->jact;
$this->params['breadcrumbs'][] = ['label' => 'Judgment Acts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-act-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->jact], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->jact], [
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
            'jact',
            'judgment_code',
            'bareact_catgid',
            'bareact_catg_name',
            'bareact_id',
            'act_name',
            'catg_id',
            'catg_title',
            'country_code',
            'country_name',
        ],
    ]) ?>

</div>

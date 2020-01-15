<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\JournalMast */

$this->title = $model->journal_code;
$this->params['breadcrumbs'][] = ['label' => 'Journal Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-mast-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->journal_code], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->journal_code], [
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
            'journal_code',
            'journal_name',
            'shrt_name',
            'pub_freq',
            'remark',
        ],
    ]) ?>

</div>

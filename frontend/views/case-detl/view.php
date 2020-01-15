<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CaseDetl */

$this->title = $model->tran_id;
$this->params['breadcrumbs'][] = ['label' => 'Case Detls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-detl-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->tran_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->tran_id], [
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
            'tran_id',
            'cust_id',
            'case_id',
            'userid',
            'hearing_date',
            'start_time',
            'lawyers_name',
            'judges_name',
            'next_hearing_date',
            'case_charged',
            'case_notes:ntext',
        ],
    ]) ?>

</div>

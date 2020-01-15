<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Invc Detls';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invc-detl-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Invc Detl', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            'invc_numb',
            'invc_qty',
            'invc_rate',
            'invc_amt',
            //'invc_desc',
            //'disc',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

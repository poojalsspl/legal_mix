<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\FaqSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faqs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Faq', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'faq_id',
           // 'faq_catg_id',
            'faq_title',
            'faq_date',
           // 'faq_desc:ntext',
            [
             'attribute'=>'faq_desc',
             'value'=>'truncatedFaqs',//show limited characters
            ],
            //'status',
            //'posted_by',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

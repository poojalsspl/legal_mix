<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BareactDetailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bareact Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bareact-detail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bareact Detail', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'catg_id',
            //'bareact_id',
            'source_catg_id',
            'old_catg_id',
            'catg_type',
             'catg_title',
             'Enactment_date',
            // 'catg_text:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

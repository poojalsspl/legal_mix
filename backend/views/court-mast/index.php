<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CourtMastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Court Masts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="court-mast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Court Mast', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'court_code',
            'court_name',
            'court_shrt_name',
            'court_type',
            'bench_status',
            // 'court_status',
            // 'city_code',
            // 'city_name',
            // 'state_code',
            // 'state_name',
            // 'country_code',
            // 'country_name',
            // 'court_remark',
            // 'court_address',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

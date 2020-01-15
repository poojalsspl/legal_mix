<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CityMastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'City Masts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="city-mast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create City Mast', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'city_code',
            'city_name',
            'shrt_name',
            'state_code',
            'state_name',
            // 'state_shrt_name',
            // 'country_code',
            // 'country_name',
            // 'country_shrt_name',
            // 'court_stat',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

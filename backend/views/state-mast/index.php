<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\StateMastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'State Masts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="state-mast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create State Mast', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'state_code',
            'state_name',
            'shrt_name',
            'zone',
            'country_code',
            // 'country_name',
            // 'country_shrt_name',
            // 'cr_date',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

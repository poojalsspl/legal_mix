<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BareactMastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bareact Masts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bareact-mast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Bareact Mast', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bareact_id',
            'old_bareact_id',
            'source_act_id',
            'act_name',
            'bareact_catgid',
             'bareact_catg_name',
            // 'tot_section',
            // 'tot_chap',
            // 'Enactment_date',
            // 'bareact_text:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

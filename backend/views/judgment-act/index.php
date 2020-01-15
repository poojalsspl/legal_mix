<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JudgmentActSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Judgment Acts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-act-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Judgment Act', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'jact',
            'judgment_code',
            'bareact_catgid',
            'bareact_catg_name',
            'bareact_id',
            // 'act_name',
            // 'catg_id',
            // 'catg_title',
            // 'country_code',
            // 'country_name',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

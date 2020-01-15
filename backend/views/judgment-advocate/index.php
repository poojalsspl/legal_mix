<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JudgmentAdvocateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Judgment Advocates';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-advocate-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Judgment Advocate', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'judgment_code',
//            'judgmentCode.judgment_title',
            [
               'attribute' => 'title',
               'label'  => 'Title',
                'filter' => true,     
                'value' => 'judgmentCode.judgment_title' 
            ],   
            [
               'attribute' => 'name',
               'label'  => 'Court',
                'filter' => true,     
                'value' => 'judgmentCode.court_name' 
            ],   

            //'advocate_name',
            //'advocate_flag',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

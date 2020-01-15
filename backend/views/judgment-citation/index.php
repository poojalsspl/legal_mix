<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JudgmentCitationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Judgment Citations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-citation-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Judgment Citation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'judgment_code',
            'journal_code',
            'journal_name',
            'shrt_name',
            // 'judgment_date',
            // 'citation',
            // 'journal_year',
            // 'journal_volume',
            // 'journal_pno',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

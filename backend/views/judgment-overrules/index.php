<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\JudgmentOverrulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Judgment Overrules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-overrules-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'judgment_code',
            'over_rules_code',
            'over_rules_title',

        ],
    ]); ?>
<?php Pjax::end(); ?></div>

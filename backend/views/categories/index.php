<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CategoriesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categories-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Categories', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cat_id',
            'cat_title',
/*            [
			  'attribute' => 'cat_meta_keywords',
			   'headerOptions' => ['style' => 'width:20%'],
			],*/
					[
               'attribute'=>"cat_meta_keywords",
               'format' => 'raw', 
               //'filter' => false,
               'value' => function($model){

               return   '<div class="content-size">'.$model->cat_meta_keywords.'</div>';
               },
             'contentOptions' => ['width' => '10%',"class"=>"column-reservations"], 
            ],
            [
               'attribute'=>'cat_meta_desc',
               'format' => 'raw', 
               //'filter' => false,
               'value' => function($model){

               return   '<div class="content-size">'.$model->cat_meta_desc.'</div>';
               },
             'contentOptions' => ['width' => '10%',"class"=>"column-reservations"], 
            ],


			/*[
			  'attribute' => 'cat_meta_desc',
			   'headerOptions' => ['style' => 'width:20%'],
			   'format' => 'raw',
			   'value'=>'$data["name"]',
			],*/
			[
			  'attribute' => 'cat_root',
			   'headerOptions' => ['style' => 'width:10%'],
			],
			
            
            // 'cat_image',
            // 'cat_desc:ntext',
            // 'cat_nav',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
<style type="text/css">
	.content-size {
    width: 150px;
    overflow: hidden;
}
</style>
<?php
use yii\helpers\Html;
use frontend\models\JudgmentComments;
use yii\grid\GridView;
use yii\widgets\Pjax;

?>

 <?php Pjax::begin(); ?>    
           <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            [
             'attribute'=>'judgment_code',
             'label'=>'Judgment',
             'value'=>'jTitle.judgment_title',//show name in place of email 
            ],
            [
             'attribute'=>'judgment_user_comment',
             'value'=>'truncatedAbstract',//show limited characters
            ],
            'crdt:date',//diaplay only date from datetime
            
            

           ['class' => 'yii\grid\ActionColumn',
            'header'=>'Actions',
            'template' => '{View}', 
            'buttons' => [
                
               'View' => function ($url, $model, $key) {
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['abstract-view', 'id'=>$model->id]);
            },
             
                'format' => 'raw',

              ],
                 'contentOptions' => [ "class"=>'action-btns', 'width'=>''],
        ],


        ],
    ]); ?>
<?php Pjax::end(); ?>
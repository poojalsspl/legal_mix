<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<h3> <?php $this->title = 'Customer Master'; ?> </h3>
<?php  //$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" >
<div class="table-responsive">
<div class="cust-mast-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <p>
        <?= Html::a('Create Customer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'custid',
            'custname',
            //'userid',
            //'username',
            //'custlogo',
            //'regsdate',
            //'dob',
            'mobile1',
            //'mobile2',
            //'fax',
            //'tele',
            'email:email',
            //'custaddr',
            //'city_code',
            'city_name',
            //'state_code',
            //'state_name',
            //'country_code',
            //'country_name',
            //'panno',
            //'gstno',
            //'adharno',
            //'cust_status_id',
            //'cust_status_name',
            //'cust_type_id',
            //'cust_type_name',
             [
                    'attribute'=>'Check Invoice',
                    'format'=>'raw',
                    'value' => function($dataProvider)
                    {
                        return
                        Html::a("Invoice", ['invc-mast/list','custid'=>  $dataProvider->custid], ['title' => 'View','class'=>'yii\grid\ActionColumn']);
                    }
            ],
            [
                    'attribute'=>'Create Receipt',
                    'format'=>'raw',
                    'value' => function($dataProvider)
                    {
                        return
                        Html::a("Receipt", ['receipt/create','custid'=>  $dataProvider->custid], ['title' => 'View','class'=>'yii\grid\ActionColumn']);
                    }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
</div>

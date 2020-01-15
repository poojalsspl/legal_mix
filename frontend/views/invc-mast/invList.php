<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\InvcMast;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice List';
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
<div class="container-fluid">
<h3>Name: <?php echo $model['custname']; ?></h3>
 <div class="row">
    <div class="col-sm-4">Email: <?php echo $model['email']; ?></div>
    <div class="col-sm-4">Mobile1: <?php echo $model['mobile2']; ?></div>
 </div>
  <div class="row">
    <div class="col-sm-4">City: <?php echo $model['city_name']; ?></div>
    <div class="col-sm-4">Mobile2: <?php echo $model['mobile1']; ?></div>
 </div>
 <br>
  <div class="row">
    <div class="col-sm-4">
         <p>
            <?= Html::a('Create Invoice', ['create'], ['class' => 'btn    btn-success']) ?>
        </p>
    </div>
    <div class="col-sm-4"></div>
 </div>
</div>

<?php  
        $custid = $_GET['custid'];
        $user_id = Yii::$app->user->identity->id;

    $dataProvider = new ActiveDataProvider([
           'query' => InvcMast::find()
           ->where(['custid'=> $custid])
           ->andWhere(['userid'=> $user_id]),
           'pagination' => [
           'pageSize' => 20,
    ],
]);
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'invc_date',
            'invc_numb',
            'invc_amt',
            'GST',
            'invc_disc',
            'paid_amount',
            //'disc',

            ['class' => 'yii\grid\ActionColumn' ,
            'buttons' => [
                'additional_icon' => function ($url, $dataProvider, $key) {
                    return Html::a ( '<span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> ', ['invc-mast/invpdf', 'id' => $dataProvider->invc_numb]
                     );
                },
            ],
            'template' => '{additional_icon}'
        ],
        ],
    ]); ?>
</div>

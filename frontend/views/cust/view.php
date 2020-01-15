<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CustMast */

$this->title = $model->custid;
$this->params['breadcrumbs'][] = ['label' => 'Cust Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cust-mast-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->custid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->custid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'custid',
            'custname',
            'userid',
            'username',
            'custlogo',
            'regsdate',
            'dob',
            'mobile1',
            'mobile2',
            'fax',
            'tele',
            'email:email',
            'custaddr',
            'city_code',
            'city_name',
            'state_code',
            'state_name',
            'country_code',
            'country_name',
            'panno',
            'gstno',
            'adharno',
            'cust_status_id',
            'cust_status_name',
            'cust_type_id',
            'cust_type_name',
        ],
    ]) ?>

</div>

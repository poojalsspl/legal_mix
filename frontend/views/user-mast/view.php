<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserMast */

$this->title = $model->uid;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Masts'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-mast-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->uid], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->uid], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'uid',
            'userid',
            'username',
            'gender',
            'user_pic',
            'sign_date',
            'bar_reg_no',
            'dob',
            'mobile_1',
            'mobile_2',
            'landline_1',
            'landline_2',
            'fax',
            'email:email',
            'alt_email:email',
            'grad_yr',
            'practice_since',
            'city_code',
            'city_name',
            'state_code',
            'state_name',
            'country_code',
            'country_name',
            'user_address',
            'pin_code',
            'status',
        ],
    ]) ?>

</div>

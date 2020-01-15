<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserMastSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Masts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-mast-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Mast', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'uid',
            'userid',
            'username',
            'gender',
            'user_pic',
            // 'sign_date',
            // 'bar_reg_no',
            // 'dob',
            // 'mobile_1',
            // 'mobile_2',
            // 'landline_1',
            // 'landline_2',
            // 'fax',
            // 'email:email',
            // 'alt_email:email',
            // 'grad_yr',
            // 'practice_since',
            // 'city_code',
            // 'city_name',
            // 'state_code',
            // 'state_name',
            // 'country_code',
            // 'country_name',
            // 'user_address',
            // 'pin_code',
            // 'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

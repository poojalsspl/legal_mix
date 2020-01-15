<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CustMast */

$this->title = 'Update Cust Mast: ' . $model->custid;
$this->params['breadcrumbs'][] = ['label' => 'Cust Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->custid, 'url' => ['view', 'id' => $model->custid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cust-mast-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

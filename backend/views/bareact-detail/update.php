<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BareactDetail */

$this->title = 'Update Bareact Detail: ' . $model->catg_id;
$this->params['breadcrumbs'][] = ['label' => 'Bareact Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->catg_id, 'url' => ['view', 'id' => $model->catg_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bareact-detail-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

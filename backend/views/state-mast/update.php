<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\StateMast */

$this->title = 'Update State Mast: ' . $model->state_code;
$this->params['breadcrumbs'][] = ['label' => 'State Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->state_code, 'url' => ['view', 'id' => $model->state_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="state-mast-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

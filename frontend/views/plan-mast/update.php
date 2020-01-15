<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PlanMast */

$this->title = 'Update Plan Mast: ' . $model->plan_code;
$this->params['breadcrumbs'][] = ['label' => 'Plan Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->plan_code, 'url' => ['view', 'id' => $model->plan_code]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="plan-mast-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

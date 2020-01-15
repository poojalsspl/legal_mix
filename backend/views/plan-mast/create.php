<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\PlanMast */

$this->title = 'Create Plan Mast';
$this->params['breadcrumbs'][] = ['label' => 'Plan Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="plan-mast-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

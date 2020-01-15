<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\InvcDetl */

$this->title = 'Update Invc Detl: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Invc Detls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="invc-detl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

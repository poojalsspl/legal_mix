<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CaseMast */

$this->title = 'Update Case Mast: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Case Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="case-mast-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CaseDetl */

$this->title = 'Update Case Detl: ' . $model->tran_id;
$this->params['breadcrumbs'][] = ['label' => 'Case Detls', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tran_id, 'url' => ['view', 'id' => $model->tran_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="case-detl-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

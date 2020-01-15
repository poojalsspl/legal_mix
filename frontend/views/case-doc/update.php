<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CaseDoc */

$this->title = 'Update Case Doc: ' . $model->Id;
$this->params['breadcrumbs'][] = ['label' => 'Case Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->Id, 'url' => ['view', 'id' => $model->Id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="case-doc-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentAct */

$this->title = 'Update Judgment Act: ' . $model->jact;
$this->params['breadcrumbs'][] = ['label' => 'Judgment Acts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->jact, 'url' => ['view', 'id' => $model->jact]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="judgment-act-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

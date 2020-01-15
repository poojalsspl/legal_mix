<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\BareactCatg */

$this->title = 'Update Bareact Catg: ' . $model->bareact_catgid;
$this->params['breadcrumbs'][] = ['label' => 'Bareact Catgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bareact_catgid, 'url' => ['view', 'id' => $model->bareact_catgid]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bareact-catg-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

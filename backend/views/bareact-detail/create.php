<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BareactDetail */

$this->title = 'Create Bareact Detail';
$this->params['breadcrumbs'][] = ['label' => 'Bareact Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bareact-detail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

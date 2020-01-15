<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\BareactCatg */

$this->title = 'Create Bareact Catg';
$this->params['breadcrumbs'][] = ['label' => 'Bareact Catgs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bareact-catg-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

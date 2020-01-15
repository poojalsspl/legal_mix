<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentCitedBy */

$this->title = 'Create Judgment Cited By';
$this->params['breadcrumbs'][] = ['label' => 'Judgment Cited Bies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-cited-by-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

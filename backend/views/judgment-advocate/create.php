<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\JudgmentAdvocate */

$this->title = 'Create Judgment Advocate';
$this->params['breadcrumbs'][] = ['label' => 'Judgment Advocates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="judgment-advocate-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

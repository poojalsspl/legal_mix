<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CaseDoc */

//$this->title = 'Create Case Doc';
$this->params['breadcrumbs'][] = ['label' => 'Case Docs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-doc-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

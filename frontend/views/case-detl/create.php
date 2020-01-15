<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CaseDetl */

//$this->title = 'Create Case Detl';
$this->params['breadcrumbs'][] = ['label' => 'Case Detls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-detl-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

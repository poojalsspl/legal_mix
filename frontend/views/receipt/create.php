<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\receipt */

$this->title = 'Create Receipt';
//$this->params['breadcrumbs'][] = ['label' => 'Receipts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'InvcDetl' =>  $InvcDetl,
       ]) ?>

</div>

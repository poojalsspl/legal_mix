<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CustMast */

//$this->title = 'Create Customer';
$this->params['breadcrumbs'][] = ['label' => 'Cust Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cust-mast-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

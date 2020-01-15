<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CaseMast */

//$this->title = 'Create Case';
$this->params['breadcrumbs'][] = ['label' => 'Case Masts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-mast-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\JournalMast */

$this->title = 'Create Journal Mast';
$this->params['breadcrumbs'][] = ['label' => 'Journal Masts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-mast-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

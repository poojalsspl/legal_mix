<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Case Documents';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="case-doc-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="table-responsive">
    <div class="container">
      <div class="row">
      <div class="col-sm-8">
      <div class="panel panel-primary">
      <div class="panel-heading"> <?php echo $model->case_desc; ?></div>
      <div class="panel-body">
           <table width="80%">
               <tr>
                <td> <label for="first_name">Registration date : <span class="content"> <?php echo $model->case_reg_date; ?> </span> </label> </td>
                <td>  <label for="last_name">Appeal Number: <span class="content"> <?php echo $model->appeal_number; ?> </span></label> </td>
                <td>  <label for="last_name">Appellant name: <span class="content"> <?php echo $model->appellant_name; ?> </span></label></td>
               </tr>

               <tr>
                <td> <label for="first_name">Respondant name : <span class="content"> <?php echo $model->respondant_name; ?> </span> </label> </td>
                <td>  <label for="last_name">Case fees: <span class="content"> <?php echo $model->case_fees; ?> </span></label> </td>
                <td>  </td>
               </tr>

               <tr>
                <td rowspan="3"> <label for="last_name">Case Summary: <span class="content"> <?php echo $model->case_summary; ?> </span></label> 
                </td>
               </tr>
           </table> 
    </div>
</div>
</div>
</div>
 <div class="row">
 <?php $id =  $model->Id; ?>
    <?php 
   Modal::begin([
            'header' => '<h3>Case documents</h3>',
            'id'     => 'model',
            'size'   => 'model-lg',
    ]);
    echo "<div id='modelContent'></div>";
    Modal::end();
?>  

   
   <div class="form-group">
   <div class="col-lg-2">
   <?= Html::button('Add Case docs', ['id' => 'modelButton', 'value' => \yii\helpers\Url::to(['case-doc/create?id='.$id]), 'class' => 'btn btn-success']) ?>
   </div> 
   <div class="col-lg-2">
    <a href="<?= Yii::$app->params['domainName'] ?>case-mast/index" class='btn btn-success'>Back to Case Diary</a>
   
 </div>
 <div class="col-lg-2">
 
    <a href="<?= Yii::$app->params['domainName'] ?>case-mast/index?id=<?php echo $id ?>" class='btn btn-success'>Case Hearings</a>
  </div>
</div>
</div>
 <br>
 <div class="row">
 <div class="col-lg-10">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'Id',
            //'userid',
            'cust_id',
            //'case_id',
            'doc_type_id',
            'doc_url:url',
            //'case_doc_type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
</div>
</div> 
</div>

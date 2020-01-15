<?php
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Case Hearing details';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
<div class="table-responsive">
      <div class="row">
      <div class="col-sm-8">
      <br>
      <div class="panel panel-primary">
      <div class="panel-heading"> <?php echo $model->case_desc; ?></div>
      <div class="panel-body">
     
           <table width="100%">
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
            'header' => '<h3>Case Hearing details</h3>',
            'id'     => 'model',
            'size'   => 'model-lg',
    ]);
    echo "<div id='modelContent'></div>";
    Modal::end();
?>  
 <div class="form-group">
 <div class="col-lg-2">
   <?= Html::button('Add hearing details', ['id' => 'modelButton', 'value' => \yii\helpers\Url::to(['case-detl/create?id='.$id]), 'class' => 'btn btn-success']) ?>
 </div>
  
   <div class="col-lg-2">
    <a href="<?= Yii::$app->params['domainName'] ?>case-mast/index" class='btn btn-success'>Back to Case Diary</a>
   
 </div>
  <div class="col-lg-2">
    <a href="<?= Yii::$app->params['domainName'] ?>case-doc/index?id=<?php echo $id ?>" class='btn btn-success'>Case documents</a>
 </div>
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
            //'tran_id',
            //'cust_id',
            //'case_id',
            //'userid',
            'hearing_date',
            'start_time',
            'lawyers_name',
            'judges_name',
            'next_hearing_date',
            'case_charged',
            //'case_notes:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div> 
</div>
</div> 


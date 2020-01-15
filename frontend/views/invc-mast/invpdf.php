<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use app\models\CustMast;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\InvcMast */

//print_r($model);
//exit;
$this->title = $model['invc_numb'];
//$this->params['breadcrumbs'][] = ['label' => 'Invc Masts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">
<div class="invc-mast-view">
    <div class="customer-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
      <h2 style="text-align: center;"><?php echo "Invoice";//Html::encode($this->title) ?></h2>
    <div class="row">
      <div class="col-sm-6">
           <?php echo "Invoice Number: ".$model['invc_numb'] ?>
      </div>
      <div class="col-sm-6">
             <?php echo "Invoice Date: ".$model['invc_date']; ?>
       </div>
    </div>
      <div class="row">
      <div class="col-sm-6">
           <?php echo "Customer name: ". $model['custname'] ?>
      </div>
      <div class="col-sm-6">
            <?php echo "Address: ".$model['custaddr']; ?>
       </div>
    </div>
    </div>
 <div class="row">
      <div class="col-sm-12">
    <table class="table table-bordered">
<tr>
  <th>Serial No.</th>
  <th>Description</th>
  <th>Quantity</th>
  <th>Rate</th>
  <th>GST</th>
  <th>Discount</th>
  <th>Amount</th>
</tr>
<?php
//echo "<pre>";
//print_r($InvcDetl);
//exit;
$i = 1;
foreach ($InvcDetl as $key => $value) {
echo '<tr><td>'.$i.'</td>';    
echo '<td>'.$value['invc_desc'].'</td>';
echo '<td>'.$value['invc_qty'].'</td>';
echo '<td>'.$value['invc_rate'].'</td>';
echo '<td>'.$value['gst'].'</td>';
echo '<td>'.$value['disc'].'</td>';
echo '<td>'.$value['invc_amt'].'</td></tr>';
$i++;
}

//var_dump($results);
?>
</table>
<?php echo "Invoice Amount: ".$model['invc_amt']; ?>
</div>
<?= Html::a('Generate PDF', ['invc-mast/InvoicePDF'], ['class'=>'btn btn-primary']) ?>
</div>
</div>
</div>
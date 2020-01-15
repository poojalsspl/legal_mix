<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use app\models\CustMast;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use app\models\InvcDetlSearch;
use app\models\Receipt;

/* @var $this yii\web\View */
/* @var $model app\models\receipt */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="receipt-form">
<?php $form = ActiveForm::begin(); ?>
<?php /* code started */ 
/*  $query = InvcDetl::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
*/
?>
<div class="container">
  <div>
      <div class="panel panel-primary">
      <div class="panel-heading">Receipt</div>
    <div class="row">
    <div class="col-sm-4">
            <?php 
     echo $form->field($model, 'payment_date')->widget(DatePicker::className(), ['language' => 'en', 'options' => ['placeholder' => 'Select payment date ...','style'=>'width:220px'], 'pluginOptions' => ['format' => 'yyyy-mm-dd', 'todayHighlight' => true]]); ?>
      </div>
       <div class="col-sm-4">

     <?php $payment_mode = array('Cash'=>'Cash','Cheque'=>'Cheque','NEFT'=>'NEFT','RTGS'=>'RTGS','NEFT'=>'NEFT');?> 
      <?= $form->field($model, 'instrument_mode')->dropDownList($payment_mode,array('style'=>'width:200px;', 'prompt'=>'--Select --')); ?>

      
      </div>
      <div class="col-sm-4">
          <?= $form->field($model, 'instrument_no')->textInput(['style'=>'width:200px']) ?>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
      <?= $form->field($model, 'instrument_date')->widget(DatePicker::className(), ['language' => 'en', 'options' => ['placeholder' => 'Select date ...','style'=>'width:220px'], 'pluginOptions' => ['format' => 'yyyy-mm-dd', 'todayHighlight' => true]]); ?>
      </div>
      <div class="col-sm-4">
         <?= $form->field($model, 'paid_amt')->textInput(['style'=>'width:200px','Id'=>'paid_amt','readonly' => true, 'value' => '0']) ?>
      </div>
      <div class="col-sm-4">
      <?= $form->field($model, 'bank_name')->textInput(['style'=>'width:200px']) ?>
      </div>
 </div>
   
    <div class="row">
    
      <div class="col-sm-4">
         <?= $form->field($model, 'remarks')->textarea(['rows' => '2','cols'=>'2','style'=>'width:300px']) ?>
      </div>
    </div>
</div>
</div>
  <div class="row">
      <div class="col-sm-12">
 <?php 
 if(!empty($InvcDetl)){ ?>
    <table class="table table-bordered">
<tr>
  <th>Serial No.</th>
  <th>Customer</th>
  <th>Description</th>
  <th>Quantity</th>
  <th>Rate</th>
  <th>GST</th>
  <th>Discount</th>
  <th>Amount</th>
  <th>Paid Amount</th>
</tr>
<?php
//echo "<pre>";
//print_r($InvcDetl);
//exit;
// $receipt = new receipt();
 //$value = $_POST["Receipt[cust_id]"];
 //echo $value;
 //exit;
 //$InvcDetl = $receipt->getInvcDetl('13');

    $i = 1;
    foreach ($InvcDetl as $key => $value) {
            echo '<tr><td>'.$i.'</td>';  
            echo '<td>'.$value['custname'].'</td>';  
            echo '<td>'.$value['invc_desc'].'</td>';
            echo '<td>'.$value['invc_qty'].'</td>';
            echo '<td>'.$value['invc_rate'].'</td>';
            echo '<td>'.$value['gst'].'</td>';
            echo '<td>'.$value['disc'].'</td>';
            echo '<td>'.$value['invc_amt'].'</td>';
            echo '<td><input class="amt" type="text" name="paid_amt[]" value='.$value['paid_amt'].'></td></tr>';
            $i++;
            }
        } else{
            echo "No pending invoice !!";
        }
//var_dump($results);
?>
</table>
<?php //echo "Invoice Amount: ".$model['invc_amt']; ?>
<div class="row">
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>
   </div>
</div>
</div>
</div>
<?php
$script = <<< JS
$(document).ready(function(){
   $('.amt').blur(function() {
   findTotal();
 });
});

function findTotal(){
   
    var arr = document.getElementsByClassName('amt');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    //alert(tot);
    document.getElementById('receipt-paid_amt').value = tot;
}

JS;
$this->registerJs($script);
?>
 <?php ActiveForm::end(); ?>
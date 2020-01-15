<?php
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;
    
    $js = <<<JS

        function printChecked2(checkboxElem,price){
        var sum = 0;
        var total= 0;
        var total=document.getElementById('total2').value;
       
        if (checkboxElem.checked) {
            sum = Number(total) + Number(price);
        } else {
            sum = Number(total) - Number(price);
        }
        //alert(sum);
        document.getElementById('total2').value = sum;
      }  
     
      function calculatetotal2(){
         var sum = 0;
         var total= 0;
         var duration=document.getElementById('duration2').value;
         //alert(duration);
         var total=document.getElementById('total2').value;
        if(duration){
          sum = Number(total) * Number(duration); 
          document.getElementById("ftotal2").value =sum;
        }
      }


      function activaTab(tab){
        $('.nav-tabs a[href="#' + tab + '"]').tab('show');
       };
      activaTab('individual');
JS;

$this->registerJS($js);
?>

<?php $form = ActiveForm::begin();?>

<div class="col-md-12 align-center plan-title-row">
    <span class="plan-select-title align-center">SELECT YOUR PLAN</span>
</div>

<div class="tab-plan-content col-md-12">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <!-- List group -->
                        <ul class="list-group">
                            <?php foreach ($plan_items as $key => $value):?>
                            
                            <li class="list-group-item">
                                    
                                    <input id="<?='switch' . $key ?>"  onchange="printChecked2(this,<?php echo $value; ?>)" name="court_name[]" type="checkbox" id="checkbox" value="<?=$key?>" data-onstyle="success" data-toggle="toggle"/>
                                    <label for="<?='switch' . $key ?>" class="label-success"></label>
                                
                                <span class="plan-item-price pull-right">
                                    <input type="text"  name="price[]" value="<?=$value?>" readonly>
                                </span>

                            </li>
                            <?php endforeach;?>
                        </ul>
                    </div>            
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <!-- List group -->
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="plan-item-title">TOTAL</span>
                                <span class="plan-item-price pull-right">
                                    <input type="text" id="total2" name="total" value="0" readonly>
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span class="plan-item-title">DURATION</span>
                                <span class="plan-item-price pull-right">
                                    <select name="duration" id="duration2" onchange="calculatetotal2()">
                                        <option value="">Select Tenure</option>
                                        <option value="1">1 Month</option>
                                        <option value="2">2 Months</option>
                                        <option value="3">3 Months</option>
                                        <option value="4">4 Months</option>
                                        <option value="5">5 Months</option>
                                        <option value="6">6 Months</option>
                                        <option value="7">7 Months</option>
                                        <option value="8">8 Months</option>
                                        <option value="9">9 Months</option>
                                        <option value="10">10 Months</option>
                                        <option value="11">11 Months</option>
                                        <option value="12">12 Months</option>
                                    </select> 
                                </span>
                            </li>
                            <li class="list-group-item">
                                <span class="plan-item-title">FINAL TOTAL</span>
                                <span class="plan-item-price pull-right">
                                    <input type="text" id="ftotal2"  name="ftotal" value="" readonly>
                                </span>
                            </li>

                        </ul>
                    </div>            
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-xs-12">
            <?= Html::submitButton('Submit', ['class' => 'btn theme-blue-button']) ?>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>


<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\PlanMaster */
/* @var $form ActiveForm */
?>


<?php 
   $authItem = ArrayHelper::map($model,'court_name','expiry_date'); 
   //echo "<pre>";print_r($authItem) ; exit;
?>
  
  <div class="table-responsive" style="padding-left:50px">
  <h1 style="text-align: center;">Membership Expiry Details</h1>
 
  <table class="table table-striped">  
  <?php $form = ActiveForm::begin();

    $count = count($authItem); 
    $i=0;
    ?>
        <thead>
      <tr>
        <th>S.No</th>
        <th>Court Name</th>
        <th>Expiry Date</th>
      </tr>
    </thead>

     <tbody>

   <?php foreach ($authItem as $key => $value) {
    $i=$i+1;
    ?>

      <tr>
        <td><?php echo $i; ?> </td>
        <td><?php echo $key; ?></td>
        <td><?php echo date("d/m/Y", strtotime($value)); ?></td>
        
      </tr>
    

     <?php }
     ?> 
    <?php  $url = Url::toRoute(['site/editplannew']); ?>
    
    
    <table>
    	
    	<!-- 	<center><a href="<?php //echo $url ?>"><?php //echo "Update Membership" ?></a></center> -->
    	
    </table>

     </tbody>
     <br>

   
    <?php ActiveForm::end(); ?>
    </table>
    </div>
    

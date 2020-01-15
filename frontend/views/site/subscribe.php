<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\UserMast;
/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */

    $form = ActiveForm::begin(); 
  
  ?>
  <div style="text-align:center;" class="top">
  <h3>Select Subscription Plans For Accessing Data</h3>
  <hr>
 
  <?php 

   $authItem = ArrayHelper::map($model,'name','name'); 
     $price = ArrayHelper::map($model,'price','price'); 
 
  ?>
  <div class="divTable">
  <div class="divTableBody">

  <div class="divTableRow">
  <div class="divTableCell">
 
     
<?php echo $form->field($model, 'user_id')->checkBoxList($authItem); ?>


 

  
  </div>

</div>
</div>
</div><!--container-->
</div><!--f-bg-w3l-->
    <?php ActiveForm::end(); ?>

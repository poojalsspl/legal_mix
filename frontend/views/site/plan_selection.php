<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\models\UserMast;
/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */

    $form = ActiveForm::begin(); 
    $baseUrl =   \Yii::$app->request->BaseUrl;
    //exit;
  ?>
  <div style="text-align:center;" class="top">
  <h3>Select Subscription Plans For Accessing Data</h3>
  <hr>
  <?php 
  $authItems = ArrayHelper::map($authItems,'name','name'); 
  ?>
  <?php // $form->field($model, 'permissions')->checkboxList($authItems); 
  ?>
  <div class="divTable">
<div class="divTableBody">
<div class="divTableRow">
<div class="divTableCell"><label for="x"> <input type="checkbox" name="supreme_court" value="supreme_court">  <span>Supreme Court</span></label> </div>
<div class="divTableCell"> <select name="supreme_court">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  </select> </div>
<div class="divTableCell"><input type="text" name="supreme_court_rates"></div>
</div>
<div class="divTableRow">
<div class="divTableCell"><label for="x"> <input type="checkbox" name="mumbai_highcourt" value="mumbai_highcourt">
  <span>Mumbai High Court</span></label> </div>
<div class="divTableCell"><select name="mumbai_highcourt">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  </select> </div>
<div class="divTableCell"><input type="text" name="mumbai_highcourt_rates"></div>
</div>
<div class="divTableRow">
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
</div>
<div class="divTableRow">
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
</div>
<div class="divTableRow">
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
<div class="divTableCell">&nbsp;</div>
</div>
</div>
</div>
  
 

 </div><!--container-->
 </div><!--f-bg-w3l-->
    <?php ActiveForm::end(); ?>
</div>
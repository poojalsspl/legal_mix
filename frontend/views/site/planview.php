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
   $authItem = ArrayHelper::map($model,'plan','expiry_date'); 
   //echo "<pre>";print_r($authItem) ; exit;
?>
  <?php $form = ActiveForm::begin();
    $count = count($authItem); 
    $i=0;
    ?>
<div class="template">
    <div class ="body-content">
        <div class="col-md-12 border-green">
            
            <div class="row">
                <div class="col-md-12 align-center">
                    <span class="actlist-title">
                        Membership expiry details

                    </span>
                </div>
            </div>
            
            <div class="row">
                <div class="box box-v2">
                    <div class="box-header with-border box-header-custom">
                        <div class="row">
                            <div class="col-md-1 align-left">
                                <span class="actlist-item-label">
                                      Sr.No
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-label">
                                    Court Name
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-label">
                                    Expiry Date
                                </span>
                            </div>
                             </div>
                    </div>
                    <div class="box-body">


  
   <?php foreach ($authItem as $key => $value) {
    $i=$i+1;
    ?>
     <div class="col-md-12 actlist-items odd-even">
                            <div class="col-md-1 align-left">
                                <span class="actlist-item-text">
                                    <?php echo $i; ?>
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-text">
                                   <?php echo $key; ?>
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-text">
                                    <?php echo date("d/m/Y", strtotime($value)); ?>
                                </span>
                            </div>
                           
                        </div>
                         <?php } ?> 
                           </div>
                </div>
            </div>
        </div>
    </div>
</div>


             <?php  $url = Url::toRoute(['site/editplan']); ?>
    <a href="<?php echo $url ?>"><?php echo "Update Membership" ?></a>   
       
    <?php ActiveForm::end(); ?>
    
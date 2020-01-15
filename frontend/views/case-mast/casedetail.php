<?php
use yii\helpers\Html;
use yii\bootstrap\Tabs;
use app\widgets\ButtonsContatiner;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;

?> 
<?php 
$this->title = 'Case Details';
$this->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin(); 
?>
<div class="site-reset-password">
   <h1><?= Html::encode($this->title) ?></h1>
     <div class="container bootstrap snippet" >
       <div class="row">
        <div class="col-sm-12">
         <div class="form-group">
          <div class="col-xs-6">
          <label for="first_name">Case Title : <span class="content"> <?php echo $model->case_desc; ?> </span> </label>
         </div>
        </div>
        <div class="form-group">
        <div class="col-xs-6">
           <label for="last_name">Case registration date: <span class="content"> <?php echo $model->case_reg_date; ?> </span></label>
        </div>
        </div>
        <div class="form-group">
           <div class="col-xs-6">
           <label for="phone">Appeal Number : <span class="content">
          <?php echo $model->appeal_number; ?> </span></label>
           </div>
         </div>
         <div class="form-group">
            <div class="col-xs-6">
              <label for="mobile">Appellant name : <span class="content">  <?php echo $model->appellant_name; ?> </span></label>
            </div>
          </div>
          <div class="form-group">
          <div class="col-xs-6">
          <label for="phone">Respondant name : <span class="content"> <?php echo $model->respondant_name; ?> </span></label>
          </div>
          </div>
          <div class="form-group">
          <div class="col-xs-6">
          <label for="mobile">Case fees : <span class="content">  <?php echo $model->case_fees; ?> </span></label>
          </div>
          </div>
          <div class="form-group">
          <div class="col-xs-12">
          <label for="phone">Mobile1 : <span class="content">  <?php echo $model->case_summary; ?> </span></label>
          </div>
          </div>
 

</div>
</div>
</div> 
   <div class="row" style="">
        <div class="col-lg-7">
                 <?php  Tabs::widget([
                    'items' => [
                    [
                    'label' => 'Case Details',
                    'content' => $this->render('hearing_details', ['model' => $casedetl]),
                    'active' => true
                    ],
                    [
                    'label' => 'Case Documents',
                    'content' => $this->render('case_docs', ['model' => $casedocs]),
                    ],
                    ],
                    ]);
                    // echo ButtonsContatiner::widget(['model' => $model]);
                  
?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
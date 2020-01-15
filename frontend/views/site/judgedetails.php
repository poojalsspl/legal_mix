<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\JudgmentMast;
/* @var $this yii\web\View */
/* @var $model app\models\UserMast */
/* @var $form yii\widgets\ActiveForm */
?>
  <?php //$form = ActiveForm::begin(); 
   $baseUrl =   \Yii::$app->request->BaseUrl;
    //exit;
  ?>

            	 <!--Content Section-->
                <div class="col-md-9 border-green">
                    <div class="row">
                        <div class="box box-v2">
                        <?php
                       
                        ?>
                         <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-md-12 align-center">
                                        <span class="judgement-title">
                                           <?php echo $model->judgment_title;?>
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class=" col-md-12 judgment-detail-item">
                                        <div class="col-md-3">
                                            <label class="judgement-detail-item-label"><?='Appellant Names: '?></label>
                                         </div>
                                        <div class="col-md-8">  
                                        <span class="judgement-detail-item-description"><?php echo $model->appellant_name;?></span>
                                        </div>
                                    </div>

                                       <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                     <label class="judgement-detail-item-label"><?='Respondent Names: '?></label>
                                </div>
                                <div class="col-md-8">
                                     <span class="judgement-detail-item-description"><?php echo $model->respondant_name;?></span>
                                </div>
                            </div>
                              <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                    <label class="judgement-detail-item-label"><?='Judges/Coram: '?></label>
                                </div>
                                <div class="col-md-8">
                                    <span class="judgement-detail-item-description"><?php echo $model->judges_name;?></span>
                                </div>
                            </div>
                            <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                        <label class="judgement-detail-item-label"><?='Subject: '?></label>
                                </div>
                                <div class="col-md-8">
                                        <span class="judgement-detail-item-description"><?php echo $model->jcatg_description;?></span>
                                </div>
                            </div>
                                  <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                    <label class="judgement-detail-item-label"><?='Absract: '?></label>
                                </div>
                                <div class="col-md-8">
                                    <span class="judgement-detail-item-description judgement-abstract"></span>
                                </div>  
                            </div> 
                             <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                    <label class="judgement-detail-item-label"><?='Disposition: '?></label>
                                </div>
                                <div class="col-md-8">  
                                    <span class="judgement-detail-item-description"></span>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-12 align-center">
                                <span class="judgement-content-title">JUDGEMENT</span>  
                            </div>
                            <div class="col-md-12 judgement-content-container">
                                <span class="judgment-content"><?php echo  $model->judgment_text?></span>  
                            </div>    
                        </div>  
                        </div>

                            </div>

                        </div>
                    </div>
                
                <!--End of Content Section-->






  
       

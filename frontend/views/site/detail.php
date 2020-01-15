
<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use backend\models\JudgmentMast;
use frontend\controllers\SiteController;
use backend\models\JudgmentAct;
use yii\helpers\ArrayHelper;
$this->title = 'Search';
//$this->params['breadcrumbs'][] = $this->title;
//var_dump($act_count);exit;
//echo "I am act acount".$act_count;exit;
//print_r($act_title);exit;
//print_r($adovcate_respondnat);exit;

?>
<div class="template">
    <div class ="body-content">
        <div class="col-md-12">
            <div class="row">
                
                <!--SideBar Menu-->
                <div class="col-md-3 border-green side-menu">
                    <div class="row side-menu-content">
                        <div class="box box-v2">   
                            <div class="box-body">
                                <?php

                                   $items = [];
                                    if (!empty($act_title) && $act_count > 0) {
                                       foreach ($act_title as $value) {
                                            $items[] = [
                                            'label' => 'Acts/Sections Referred('.$act_count.')',
                                            'icon' => 'plus',
                                            'items' => [],
                                        ];
                                            if (is_array($act_title)) {
                                                $items[] = [
                                                    'label' => $value
                                                     ];
                                                }
                                            }
                                     }

                                     if (!empty($judgment_citied) && $judgment_citied_count > 0) {
                                        foreach ($judgment_citied as $citied_value) {
                                            $items[] = [
                                                    'label' => 'Judgements Cited('.$judgment_citied_count.')',
                                                    'icon' => 'plus',
                                                    'items' => [],
                                                ];
                                                if (is_array($judgment_citied)) {
                                                    $items[] = [
                                                            'label' => $citied_value
                                                        ];
                                                    }
                                                }
                                    }

                                    if (!empty($judgment_citied_by) && $judgment_citied_by_count > 0 ) {
                                       foreach ($judgment_citied_by as $citiedby_value) {
                                           $items[] = [
                                            'label' => 'Judgements Cited By('.$judgment_citied_by_count.')',
                                            'icon' => 'plus',
                                            'items' => [],
                                            ];
                                            if (is_array($judgment_citied_by)) {
                                               $items[] = [
                                                            'label' => $citiedby_value
                                                          ];
                                                    }
                                            }
                                        }

                                       if (!empty($judges) && $judges_count > 0) {
                                       foreach ($judges as $judge) {
                                           $items[] = [
                                            'label' => 'Judgements Cited By('.$judges_count.')',
                                            'icon' => 'plus',
                                            'items' => [],
                                            ];
                                            if (is_array($judges)) {
                                               $items[] = [
                                                            'label' => $judge
                                                          ];
                                                    }
                                            }
                                        }

                                        if (!empty($adovcate_respondnat) ||  !empty($advocate_appellant))  {
                                           $items[] = [
                                            'label' => 'Advocate',
                                            'icon' => 'plus',
                                            'items' => [],
                                            ];
                                            [
                                            'label' => 'Responded',
                                            'icon' => 'plus',
                                            'items' => [],
                                            ];
                                            foreach ($advocate_appellant as $appellant){
                                            if (is_array($advocate_appellant)) {
                                               $items[] = [
                                                            'label' => $appellant
                                                          ];
                                                    }
                                                }
                                             foreach ($adovcate_respondnat as $respondnat){
                                               if (is_array($adovcate_respondnat)) {
                                               $items[] = [
                                                            'label' => $respondnat
                                                          ];
                                                    }
                                                }
                                             }   
                                                  
                                       
                                        
                                  

                                ?>
                                 <?=$this->render('partials/side_menu.php', ['items' => $items, 'title' => false])?>


        
                 </div>
                        </div>
                    </div>
                </div>
                <!--End of SideBar Menu-->

        
                
      


                <!--Content Section-->
                <div class="col-md-9 border-green">
                    <div class="row">
                    	
                        <div class="box box-v2">
                        <?php
                        if(!empty($data["judgment_title"])):
                        ?>
                         <div class="box-header with-border">
                                <div class="row">
                                    <div class="col-md-12 align-center">
                                        <span class="judgement-title">
                                           <?php echo $data["judgment_title"];?>
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>  
                        
                        

                      
                        <?php
                        if(!empty($data["bench_name"])):
                        ?>
                        <p class="para2" align="center" style="font-size: 16px">
                            <span><b><?php echo $data["bench_name"];?></b></span>
                        </p>
                        <?php endif; ?>
                        <p class="para2" align="left">
                            <?php
                            if(!empty($data["bench_name"])):
                            ?>
                            <span style="color:#e4353a;"><b>Appeal No:  </b></span>
                            <span><?php echo $data["bench_name"];?></span>
                            <br />
                            <?php endif; ?>
                            <?php
                            $dateText="N/A";
                            if(checkdate(date("m",strtotime($data["judgment_date"])),date("d",strtotime($data["judgment_date"])),date("Y",strtotime($data["judgment_date"])))){
                                $dateText=date("Y-m-d",strtotime($data["judgment_date"]));


                            }
                            ?>
                            <?php //print_r($data);?>
                              <div class="box-body">                                
                                <div class="judgement-detail">
                                    <div class=" col-md-12 judgment-detail-item">
                                        <div class="col-md-3">
                                             <label class="judgement-detail-item-label"><?='Judgement Date: '?></label>
                                        </div> 
                                        <div class="col-md-8"> 
                                             <span class="judgement-detail-item-description"><?php echo $dateText;?></span>
                                        </div>
                                    </div>  
                                     <div class=" col-md-12 judgment-detail-item">
                                        <div class="col-md-3">
                                             <label class="judgement-detail-item-label"><?='Court Name: '?></label>
                                        </div> 
                                        <div class="col-md-8"> 
                                             <span class="judgement-detail-item-description"><?php echo $data["court_name"];?></span>
                                        </div>
                                    </div>  
                                  
                            
                            <?php
                            if(!empty($data["citation"])):
                            ?>
                                     <div class=" col-md-12 judgment-detail-item">
                                        <div class="col-md-3">
                                            <label class="judgement-detail-item-label"><?='Citation: '?></label>
                                        </div>  
                                        <div class="col-md-8">  
                                            <span class="judgement-detail-item-description"><?php echo $data["citation"];?></span>
                                        </div>
                                    </div>    
                            <?php endif; ?>
                            <?php
                            if(!empty($data["appellant_name"])):
                            ?>
                                     <div class=" col-md-12 judgment-detail-item">
                                        <div class="col-md-3">
                                            <label class="judgement-detail-item-label"><?='Appellant Names: '?></label>
                                         </div>
                                        <div class="col-md-8">  
                                        <span class="judgement-detail-item-description"><?php echo $data["appellant_name"];?></span>
                                        </div>
                                    </div>
                            <?php endif; ?>        
                            <?php
                            if(!empty($data["respondant_name"])):
                            ?>
                            <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                     <label class="judgement-detail-item-label"><?='Respondent Names: '?></label>
                                </div>
                                <div class="col-md-8">
                                     <span class="judgement-detail-item-description"><?php echo $data["respondant_name"];?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php
                            if(!empty($data["judges_name"])):
                            ?>
                            <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                    <label class="judgement-detail-item-label"><?='Judges/Coram: '?></label>
                                </div>
                                <div class="col-md-8">
                                    <span class="judgement-detail-item-description"><?php echo $data["judges_name"];?></span>
                                </div>
                            </div>    
                            <?php endif; ?>
                            <?php
                            if(!empty($data["judges_name"])):
                            ?>
                            <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                        <label class="judgement-detail-item-label"><?='Subject: '?></label>
                                </div>
                                <div class="col-md-8">
                                        <span class="judgement-detail-item-description"><?php echo $data["judges_name"];?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php
                            if(!empty($data["judgment_abstract"])):
                            ?>
                            <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                    <label class="judgement-detail-item-label"><?='Absract: '?></label>
                                </div>
                                <div class="col-md-8">
                                    <span class="judgement-detail-item-description judgement-abstract"><?php echo $data["judgment_abstract"];?></span>
                                </div>  
                            </div>      
                            <?php endif; ?>
                            <?php
                            if(!empty($data["disposition_text"])):
                            ?>
                            <div class=" col-md-12 judgment-detail-item">
                                <div class="col-md-3">
                                    <label class="judgement-detail-item-label"><?='Disposition: '?></label>
                                </div>
                                <div class="col-md-8">  
                                    <span class="judgement-detail-item-description"><?php echo $data["disposition_text"];?></span>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div> 
                         <?php
                        if(!empty($data["judgment_text"])):
                        ?>
                        <div class="row">
                            <div class="col-md-12 align-center">
                                <span class="judgement-content-title">JUDGEMENT</span>  
                            </div>
                            <div class="col-md-12 judgement-content-container">
                                <span class="judgment-content"><?php echo $data["judgment_text"];?></span>  
                            </div>    
                        </div>              
                        <?php endif; ?>
                        <?php
                        if(!empty($data["appellant_adv"])):
                        ?>
                        <div class=" col-md-12 judgment-detail-item">
                            <div class="col-md-3">
                                <label class="judgement-detail-item-label"><?='Appellant Advocates: '?></label>
                            </div>
                            <div class="col-md-8">
                                 <span class="judgement-detail-item-description"><?php echo $data["appellant_adv"];?></span>
                             </div>
                        </div>         
                        <?php endif; ?>
                        <?php
                        if(!empty($data["respondant_adv"])):
                        ?>
                        <div class=" col-md-12 judgment-detail-item">
                            <div class="col-md-3">
                                <label class="judgement-detail-item-label"><?='Respondent Advocates:'?></label>
                            </div>
                            <div class="col-md-8">
                                 <span class="judgement-detail-item-description"><?php echo $data["respondant_adv"];?></span>
                             </div>
                        </div>       
                        <?php endif; ?>
                        </div>

                            </div>

                        </div>
                    </div>
                
                <!--End of Content Section-->
            </div>
        </div>
    </div>
</div>
                       
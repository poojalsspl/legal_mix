
<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
use backend\models\JudgmentMast;
use frontend\controllers\SiteController;
use backend\models\JudgmentAct;
$this->title = 'Search';
$this->params['breadcrumbs'][] = $this->title;
//var_dump($act_count);exit;
//echo "I am act acount".$act_count;exit;
//print_r($act_title);exit;
//print_r($adovcate_respondnat);exit;
?>


        <?php
        
        if (!empty($act_count) || !empty($ref_count)  || !empty($ref_by_count) || !empty($judge_name) || !empty($advocate_name) || !empty($advocate_respond_name) || 1==1 ) {
       
        ?>

                <?php if (!empty($act_title) && $act_count > 0) : ?>
               
                            <ul id="tree1">

                                <li> <a href="#"> Acts/Sections Referred (<?php echo $act_count;?>)</a>

                                    <ul>
                                        <?php if (!empty($act_title)):?>

                                       <?php

                                                foreach ($act_title as $values):
                                                ?>
                                        <li><?php echo $values;?></a></li>

                                        <?php endforeach; ?>
                                        <?php endif;?>

                                    </ul>
                                </li>

                            </ul>
                       
                <?php endif; ?>
                <?php if (!empty($judgment_citied) && $judgment_citied_count > 0) : ?>
                
                            <ul id="tree2">
                                <li> <a href="#"> Judgements Cited (<?php echo $judgment_citied_count;?>)</a>

                                    <ul>
                                        <?php if (!empty($judgment_citied)) :
                                            foreach ($judgment_citied as $value):
                                            ?>
                                                <li><?php echo $value;?></li>
                                            <?php endforeach; ?>
                                        <?php endif;?>

                                    </ul>
                                </li>

                            </ul>
                        
                <?php endif; ?>
                <?php if (!empty($judgment_citied_by) && $judgment_citied_by_count > 0 ) { ?>
                
                            <ul id="tree5">
                                <li> <a href="#"> Judgements Cited By(<?= $judgment_citied_by_count?>)</a>

                                    <ul>
                                        <?php if (!empty($judgment_citied_by)) :?>

                                        <?php

                                        foreach ($judgment_citied_by as $value):
                                        ?>
                                        <li><?php echo $value;?></li>

                                        <?php endforeach; ?>
                                        <?php endif;?>

                                    </ul>
                                </li>
                            </ul>
                        
                <?php }?>
                <?php if (!empty($judges) && $judges_count > 0) { ?>
                
                            <ul id="tree3">
                                <li> <a href="#"> Judges (<?php echo $judges_count;?>)</a>

                                    <ul>

                                            <?php

                                            foreach ($judges as $judge):
                                                ?>
                                                <li><?php echo $judge;?></a></li>

                                            <?php  endforeach; ?>

                                    </ul>
                                </li>

                            </ul>
                        
                <?php }?>
                <?php if (!empty($adovcate_respondnat) ||  !empty($advocate_appellant))  { ?>
                
                            <ul id="tree4">
                                <li> <a href="#"> Advocate</a>

                                    <ul>
                                        <?php if (!empty($advocate_appellant)) { ?>
                                        <li>Appellant (<?php echo $advocate_appellant_count;?>)
                                            <ul>
                                             <?php
                                                foreach ($advocate_appellant as $value):
                                             ?>
                                              <li><?php echo $value;?></li>
                                              <?php  endforeach; ?>

                                            </ul>

                                        </li>
                                        <?php } ?>
                                        <?php if (!empty($adovcate_respondnat)) { ?>
                                        <li>Responded (<?php echo $adovcate_respondnat_count;?>)
                                            <ul>
                                               <?php
                                               foreach ($adovcate_respondnat as $value):
                                               ?>
                                                <li><?php echo $value;?></li>
                                               <?php  endforeach; ?>

                                            </ul>
                                        </li>
                                        <?php }?>
                                    </ul>
                                </li>
                            </ul>
               
                <?php }?>
                <?php } ?>
     

        
                
      


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
                       
<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="template">
    <div class ="body-content">
        <div class="col-md-12 border-green">
            <div class="row">
                <div class="box box-v2">
                    <div class="box-header with-border  box-header-custom">
                        <div class="row">
                            <div class="col-md-12 align-center">
                                <div class="bareact-title">
                    <?php
                    if (!empty($data["record"]["act_group_desc"])):
                        ?>
                      
                            <?php echo $data["record"]["act_group_desc"]; ?>
                       
                    <?php endif; ?>
                    </div>
                    <div class="bareact-sub-title">
                    <?php
                    if (!empty($data["record"]["act_title"])):
                        ?>
                        
                            <?php echo $data["record"]["act_title"]; ?>
                       
                    <?php endif; ?>
                               </div>
                            </div>
                        </div>
                    </div>
                     <div class="box-body">
                        <div class="row bareact-content-title">
                            <div class="col-md-2 align-left">
                    <?php

                    if (!empty($data["record"]["act_catg_desc"])):
                        ?>
                       
                            Act Category :
                             </div>
                             <div class="col-md-10">
                             <?php echo $data["record"]["act_catg_desc"]; ?>   
                        <?php endif; ?>
                        </div>
                        </div>
                        <div class="row bareact-content-title">
                            <div class="col-md-2 align-left">
                        <?php
                        if (!empty($data["record"]["act_sub_catg_desc"])):
                            ?>
                            Sub Category : 
                        </div>
                            <div class="col-md-10">
                            <?php echo $data["record"]["act_sub_catg_desc"]; ?> 
                         
                        <?php endif; ?>
                            </div>
                        </div>
                         <div class="row bareact-content-title">
                            <div class="col-md-2 align-left">
                        <?php
                        if (!empty($data["count"]["total"])):
                            ?>
                            Act/Section Citated in: 
                           </div>
                            <div class="col-md-10">
                            <?php echo $data["count"]["total"]; ?> 
                        
                    <?php endif; ?>
                    </div>
                        </div>
                        <!--Content-->
                        <div class="row bareact-content">
                            <?php
                             if (!empty($data["record"]["body"])):
                        ?>
                        <?php echo $data["record"]["body"]; ?>
                        <?php endif; ?>

                            
                                  <div class="col-md-12 align-left bareact-content-item">
                                     <?php
                        if(!empty($data["record"]["bareact_code"]) && $data["record"]["level"] > 0 ):
                        ?>
                        <a href="<?php echo Url::current(['code' =>
                                    $data["record"]["bareact_code"]]);?>">Complete Act:</a>
                                     <?php endif; ?>
                                  </div>
                           
                        </div> 
                         <!--\Content-->
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>

                    
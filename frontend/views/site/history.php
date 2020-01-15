<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
//print_r($data);exit;

?>
<div class="template">
    <div class ="body-content">
        <div class="col-md-12 border-green">
            
            <div class="row">
                <div class="col-md-12 align-center">
                    <span class="actlist-title">
<h3><span>Browsing History</span></h3>
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
                                    Date
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-label">
                                   Browsing Url
                                </span>
                            </div>
                            
                            
                        </div>
                    </div>
                     <div class="box-body">

                          <?php
                            $K=1;
                            foreach ($data as $record):
                           ?>
                        <div class="col-md-12 actlist-items odd-even">
                            <div class="col-md-1 align-left">
                                <span class="actlist-item-text">
                                	 <?php echo $K;?>
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-text">	
                                	<?php echo $record["browse_time"];?>
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-text">
                                   <?php echo $record["browse_url"];?>
                                 </span>
                            </div> 
                          
                         
                        </div>   
                         <?php $K++; endforeach;?> 


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

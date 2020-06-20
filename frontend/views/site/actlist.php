<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
//print_r($data);exit;
if(!empty($data) && count($data)> 0):
?>
<div class="template">
    <div class ="body-content">
        <div class="col-md-12 border-green">
            
            <div class="row">
                <div class="col-md-12 align-center">
                    <span class="actlist-title">
<h3><span><?php echo $data["0"]["judgment_title"];?></span></h3>
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
                                    Group
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-label">
                                    Category
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-label">
                                    Type
                                </span>
                            </div>
                            <div class="col-md-5 align-left">
                                <span class="actlist-item-label">
                                    Title
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
                                    <?php echo $record["act_group_desc"];?>
                                </span>
                            </div>
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-text">
                                    <?php echo $record["act_catg_desc"];?>
                                 </span>
                            </div> 
                            <div class="col-md-2 align-left">
                                <span class="actlist-item-text">   
                                    <?php echo $record["act_sub_catg_desc"];?>
                                </span>
                            </div> 
                            <div class="col-md-5 align-left">
                                <span class="actlist-item-text">   
                                    <a href="<?php echo Url::to(['site/bareact/'.$record["doc_id"]],true);?>"><?php echo $record["act_title"];?></a> 
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
<?php endif;?>
<?php
use yii\helpers\Url;
if(!empty($data) && count($data)> 0):
?>
<div class="template">
    <div class ="body-content">
        <div class="col-md-12 border-green">
            <div class="row">
                <div class="col-md-12 align-center citation-title">
                    <span class="citation-title">
                    <?php echo $data["0"]["judgment_title"];?>
                        
                    </span>
                </div>
            </div>
    <div class="row">
                <div class="box box-v2">
                    <div class="box-header with-border box-header-custom">
                        <div class="row">
                            <div class="col-md-2 align-left">
                                <span class="citation-item-label">
                                Sno.
                                </span>
                            </div>
                            <div class="col-md-4 align-left">
                                <span class="citation-item-label">
                                Court Name
                                </span>
                            </div>
                            <div class="col-md-6 align-left">
                                <span class="citation-item-label">
                                Judgment Title
                                 </span>
                            </div>
                            </div>
                    </div>
                    <div class="box-body">
                           
                            <?php
                            $K=1;
                            foreach ($data as $record):

                            ?>
                            <div class="col-md-12 citation-item odd-even">
                            <div class="col-md-2 align-left">
                                <span class="citation-item-text">
                                    <?php echo $K;?>
                                </span>
                            </div>
                            <div class="col-md-4 align-left">
                                <span class="citation-item-text">
                                <?php echo $record["court_name"];?>
                                </span>
                            </div>
                            <div class="col-md-6 align-left">
                                <span class="citation-item-text">
                                    <a href="<?php echo Url::to(['site/judgment/'.$record["judgment_code"]],true);?>"><?php echo $record["judgment_title_ref"];?></a>
                                </span>
                            </div>
                        </div>
                           
                            <?php $K++; endforeach; ?>
                             </div>

                </div>
            </div>
        
        </div>
    </div>
</div>
<?php endif;?>
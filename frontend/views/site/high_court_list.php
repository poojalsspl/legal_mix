<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use frontend\models\JudgmentCourtCount;

$this->title = 'High Courts';


?>

<div class="template">
    <div class ="body-content">
        <div class="col-md-12 border-green">
            <div class="row">
                <div class="col-md-12 align-center citation-title">
                    <span class="citation-title">
                      High Court India
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
                            <div class="col-md-6 align-left">
                                <span class="citation-item-label">

                                Court Name
                                    </span>
                            </div>
                            <div class="col-md-4 align-left">
                                <span class="citation-item-label">
                                Judgment Count
                                </span>
                            </div>
                            </div>
                    </div>
                    <div class="box-body">
                            <?php
                            $K=1;
                            foreach ($models as $modelSingle):

                            ?>
                            <div class="col-md-12 citation-item odd-even">
                            <div class="col-md-2 align-left">
                                <span class="citation-item-text">
                            <?php echo $K;?>
                                </span>
                            </div>
                            <div class="col-md-6 align-left">
                                <span class="citation-item-text">
                                <a target="_blank" href="/legal_mix/site/court?court=<?php echo $modelSingle["court_name"];?>"><?php echo $modelSingle["court_name"];?></a>
                                </span>
                            </div>
                            <div class="col-md-4 align-left">
                                <span class="citation-item-text">
                                <?php echo $modelSingle["judgment_count"];?>
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


<?php
/* @var $this yii\web\View*/

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\models\JudgmentMast;
use yii\helpers\ArrayHelper;
//$this->title = $model->title;
\yii\web\YiiAsset::register($this);

$jcode = $model->judgment_code;
$judgment = ArrayHelper::map(JudgmentMast::find()->where(['judgment_code'=>$jcode])->all(),
'judgment_code','judgment_title');
foreach ($judgment as $judgment_value) { 
}
?>
<div class="template">
    <div class ="body-content">
       
           
        
        <div class="col-md-12">
            <div class="row">
            	<div class="col-md-2">
            		
            	</div>
            
           
                
                <div class="col-md-8 border-green">
                    <div class="row">
                    
                   
                        <div class="box box-v3">
                            <div class="box-header with-border box-header-custom">
                                <div class="row">
                                	
                                	<div class="col-md-6 align-left">
                                        <span class=" search-result-title">
                                            <?= $judgment_value; ?>
                                        </span>
                                    </div>
                                
                                    <div class="col-md-2 align-right" style="float: right;">
                                        <span class=" search-result-title">
                                            <?=  substr($model->crdt, 0, 10); ?>
                                        </span>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="box-body search-results-body">
                                <div class="search-result-content">
                                    <p>
                                       <?=  $model->judgment_user_comment; ?>
                                    <p>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
            		
            	</div>


            </div>
        </div>
        
    </div>
</div>
<style type="text/css">
    p{
        text-align: justify;
    }
</style>


<?php
/* @var $this yii\web\View*/

use yii\helpers\Html;
use yii\helpers\Url;
//$this->title = $model->title;
\yii\web\YiiAsset::register($this);

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
                                <div id="wrapper">
                                    <?=Html::img('@web/images/advertise/3 Post.png')?>
                                </div>        
                            </div>
                           
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9 ">
                    <div class="row">
                    
                   <center><h1><?=  $models[0]['court_name']; ?></h1></center>
                                            
                         <div class="box-body search-results-body">
                                <div class="search-result-content">
                                    <p style="font-size: 17px;text-align: justify  ">
                                       <?=  $models[0]['court_description']; ?>
                                    <p>
                                </div>
                         </div>
                        
                   </div>
                </div>
            </div>
        </div>
        
    </div>
</div>



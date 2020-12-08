<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\widgets\Menu;
    use kartik\date\DatePicker;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
                                <?=$this->render('partials1/side_menu_advanced_search1.php', ['courtsData' => $courtsData, 'title' => false])?>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of SideBar Menu-->
                
                <!--Content Section-->
                <div class="col-md-9 border-green">
                    <div class="row">
                    <div class="box box-v2">
                        <div class="box-header box-header-custom">
                            <div class="row">
                                <div class="col-md-12 align-center">
                                    <span class="advanced-search-title align-center">
                                        Advanced Searchhhh
                                    </span>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="search col-md-12">
                                <form role="form" id="form" name="form" novalidate="novalidate" action="/legal_mix/site/search">
                                    <div class="search col-md-12">
                                <div class="row" style="margin-top: 50px">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                                <label class="control-label">From</label>
                                                <?=DatePicker::widget([
                                                    'name' => 'startDate',
                                                    'attribute' => 'startDate',
                                                    'id' => 'startDate',
                                                    'options' => ['placeholder' => 'Enter start date ...'],
                                                    'pluginOptions' => [
                                                        'autoclose'=>true
                                                    ]
                                                ]);?>                                                    
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                           <label class="control-label">To</label>
                                                <?=DatePicker::widget([
                                                    'name' => 'endDate',
                                                    'attribute' => 'endDate',
                                                    'id' => 'endDate',
                                                    'options' => ['placeholder' => 'Enter end date ...'],
                                                    'pluginOptions' => [
                                                        'autoclose'=>true
                                                    ]
                                                ]);?>  
                                            </div>
                                        
                                        <input type="text" name="court_code" id="court_code" />
                                        <input type="hidden" name="advance_search" value="1" />
                                        </div>
                                    </div>
                                </div>
                                    <div class="col-md-10 col-sm-8 col-xs-12">
                                        <div class="form-group">
                                            <input type="search" class="form-control" id="textbox" name="q" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-4 col-xs-12">
                                        <button type="submit" class="btn theme-blue-button btn-block">SEARCH</button>                                
                                    </div>
                                    <input type="hidden" name="court_code" id="court_code" />
                                    <input type="hidden" name="advance_search" value="1" />
                                </form>
                            </div>
                            <div class="box-body align-center col-md-12 footer-block"  style="margin-top: 30px">
                                <div class="col-md-12 advanced-search-sub-title align-left">Advanced Search Examples</div>
                                <div class="col-md-12">
                                    <ul class="list-group advanced-search-examples">
                                        <li class="list-group-item">Murder dowry will search for words "Murder" and "Dowry"</li>
                                        <li class="list-group-item">Murder NOT dowry will search for murder where word dowry is not mentined</li>
                                        <li class="list-group-item">"Murder dowry" will search murder dowry as phrase</li>
                                        <li class="list-group-item">"Murder dowry"~10 will search for murder and dowry maximum apart from each by 10 words</li>
                                        <li class="list-group-item">Murder OR dowry will search for any of the two words</li>
                                        <li class="list-group-item">"Arms act" AND murder will look for arms act as phrase and word murder</li>
                                      </ul>
                                </div>                                
                            </div>
                            
                            </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            </div>
        </div>
        
    </div>
</div>

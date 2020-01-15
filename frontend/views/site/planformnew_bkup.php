<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PlanMaster */
/* @var $form ActiveForm */
?>
   
<div class="template">
    <div class ="body-content">
        <div class="col-md-12">
            <div class="row">
                              <div class="col-md-3 border-green side-menu">
                    <div class="row side-menu-content">
                        <div class="box box-v2">   
                            <div class="box-body">
                                <?php  $items = [
                                        [
                                            'label' => 'Indian Courts (######)', 
                                            'icon' => 'plus',
                                            'items' => [
                                                ['label' => 'Supreme Court ( ###### )',  'url' => ['#'],],
                                                ['label' => 'Calcutta High Court ( ###### )', 'url' => ['#'],],
                                                ['label' => 'Patna High Court ( ####### )', 'url' => ['#'],],
                                                ['label' => 'Karnataka High Court ( ##### )', 'icon' => '', 'url' => ['#'],],
                                            ],
                                        ],
                                        [
                                            'label' => 'Year', 
                                            'icon' => 'folder-o',
                                            'items' => [
                                                ['label' => '2015', 'icon' => 'folder', 'url' => ['#'],],
                                                ['label' => '2016', 'icon' => 'folder', 'url' => ['#'],],
                                                ['label' => '2017', 'icon' => 'folder', 'url' => ['#'],],
                                            ],
                                        ],
                                        ['label' => 'Item 2', 'icon' => 'plus', 'url' => ['/#']],
                                        ['label' => 'Item 3', 'icon' => 'plus', 'url' => ['/#']],
                                        ['label' => 'Item 4', 'icon' => 'plus', 'url' => ['/#']],

                                    ];          
                                ?>
                                <?=$this->render('partials/side_menu.php', ['items' => $items, 'title' => false])?>
                            </div>
                        </div>
                    </div>
                </div>
              <div class="col-md-9 border-green">
                <div class="row">
                        <div class="box box-v2">
                            <div class="box-body">
                                <div id="exTab2" class="tab-container"> 
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a  href="#1" data-toggle="tab" class="tab-header">INDIVIDUAL</a>
                                        </li>
                                        <li><a href="#2" data-toggle="tab" class="tab-header">CORPORATE</a>
                                        </li>
                                        <li><a href="#3" data-toggle="tab" class="tab-header">FULL ACCESS</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content ">
                                        <div class="tab-pane active" id="1">
                                          <?php
                                          //print_r($authItems)."<br>";

                                            ?>

                                            <?=$this->render('partials1/plan_individual', ['plan_items' => (ArrayHelper::map($authItems,function($authItems) {
                                            return $authItems['court_name'].'-'.$authItems['court_code'];
                                                  },'price'
                                                )
                                              )])?>

                                        </div>
                                        <div class="tab-pane" id="2">
                                            <?=$this->render('partials1/plan_corporate', ['plan_items' => (ArrayHelper::map($corpaccess,'court_name','price'))])?>
                                        </div>
                                        <div class="tab-pane" id="3">
                                            <?=$this->render('partials1/plan_full_access', ['plan_items' => (ArrayHelper::map($fullaccess,'court_name','price'))])?>
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
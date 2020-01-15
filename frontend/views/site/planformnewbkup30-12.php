<?php
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\models\JudgmentMast;

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
                               <?php  
                                    $jmast = new JudgmentMast();
                                    $supreme_court = $jmast->getJlistnew('Supreme Court-India'); 
                                    $high_court = $jmast->getJlistnew('High Court-India'); 
                                    $items_highcourt = [];
                                    foreach($high_court as $key => $value)
                                    {
                                        $items_highcourt[] = [
                                            'label' => $value["court_name"]."(".$value["judgement_count"].")",
                                            'url' => yii\helpers\Url::toRoute(['site/jlistnew', 'court_code' => $value['court_code']]),
                                            'items' => [
                                                [
                                                    'label' => 'Judgments',
                                                    'url' => yii\helpers\Url::toRoute(['site/jlistnew', 'court_code' => $value['court_code']])
                                                ]
                                            ]
                                        ];
                                    }

                                    $items = [
                                        [
                                            'label' => 'Judgments',
                                            'icon' => 'plus',
                                            'url' => yii\helpers\Url::toRoute(['site/jlistnew', 'court_code' => urlencode('1')])
                                        ],
                                        [
                                            'label' => 'High Court', 
                                            'icon' => 'plus',
                                            'items' => $items_highcourt
                                        ],
                                        
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
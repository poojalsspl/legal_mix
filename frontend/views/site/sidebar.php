   <?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use frontend\models\JudgmentMast;
?>
           <div class="col-md-3 border-green side-menu">
                    <div class="row side-menu-content">
                        <div class="box box-v2">   
                            <div class="box-body">
                            	<?php  
                                    $jmast = new JudgmentMast();
                                    $supreme_court = $jmast->getJlist('Supreme court'); 
                                    $high_court = $jmast->getJlist('High court'); 
                                    $items_highcourt = [];
                                    foreach($high_court as $key => $value)
                                    {
                                        $items_highcourt[] = [
                                            'label' => $value["court_name"]."(".$value["judgement_count"].")",
                                            'url' => yii\helpers\Url::toRoute(['site/jlist', 'court_name' => $value['court_name']]),
                                            'items' => [
                                                [
                                                    'label' => 'Judgements',
                                                    'url' => yii\helpers\Url::toRoute(['site/jlist', 'court_name' => $value['court_name']])
                                                ]
                                            ]
                                        ];
                                    }

                                    $items = [
                                        [
                                            'label' => 'Judgments',
                                            'icon' => 'plus',
                                            'url' => yii\helpers\Url::toRoute(['site/jlist', 'court_name' => urlencode('Supreme court')])
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
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

//$this->params['breadcrumbs'][] = $this->title;
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
                                <?php

                                   $items = [];
                                    if (!empty($act_title) && $act_count > 0) {
                                       foreach ($act_title as $value) {
                                            $items[] = [
                                            'label' => 'Acts/Sections Referred('.$act_count.')',
                                            'icon' => 'plus',
                                            'items' => [],
                                        ];
                                            if (is_array($act_title)) {
                                                $items[] = [
                                                    'label' => $value
                                                     ];
                                                }
                                            }
                                     }

                                     if (!empty($judgment_citied) && $judgment_citied_count > 0) {
                                        foreach ($judgment_citied as $citied_value) {
                                            $items[] = [
                                                    'label' => 'Judgements Cited('.$judgment_citied_count.')',
                                                    'icon' => 'plus',
                                                    'items' => [],
                                                ];
                                                if (is_array($judgment_citied)) {
                                                    $items[] = [
                                                            'label' => $citied_value
                                                        ];
                                                    }
                                                }
                                    }

                                    if (!empty($judgment_citied_by) && $judgment_citied_by_count > 0 ) {
                                       foreach ($judgment_citied_by as $citiedby_value) {
                                           $items[] = [
                                            'label' => 'Judgements Cited By('.$judgment_citied_by_count.')',
                                            'icon' => 'plus',
                                            'items' => [],
                                            ];
                                            if (is_array($judgment_citied_by)) {
                                               $items[] = [
                                                            'label' => $citiedby_value
                                                          ];
                                                    }
                                            }
                                        }

                                       if (!empty($judges) && $judges_count > 0) {
                                       foreach ($judges as $judge) {
                                           $items[] = [
                                            'label' => 'Judgements Cited By('.$judges_count.')',
                                            'icon' => 'plus',
                                            'items' => [],
                                            ];
                                            if (is_array($judges)) {
                                               $items[] = [
                                                            'label' => $judge
                                                          ];
                                                    }
                                            }
                                        }

                                        if (!empty($adovcate_respondnat) ||  !empty($advocate_appellant))  {
                                           $items[] = [
                                            'label' => 'Advocate',
                                            'icon' => 'plus',
                                            'items' => [],
                                            ];
                                            [
                                            'label' => 'Responded',
                                            'icon' => 'plus',
                                            'items' => [],
                                            ];
                                            foreach ($advocate_appellant as $appellant){
                                            if (is_array($advocate_appellant)) {
                                               $items[] = [
                                                            'label' => $appellant
                                                          ];
                                                    }
                                                }
                                             foreach ($adovcate_respondnat as $respondnat){
                                               if (is_array($adovcate_respondnat)) {
                                               $items[] = [
                                                            'label' => $respondnat
                                                          ];
                                                    }
                                                }
                                             }   
                                                  
                                       
                                        
                                  

                                ?>
                                 <?=$this->render('partials/side_menu.php', ['items' => $items, 'title' => false])?>


        
                 </div>
                        </div>
                    </div>
                </div>
                <!--End of SideBar Menu-->
       


      <?php $form = ActiveForm::begin(); ?>
               <h1><?= Html::encode($this->title) ?></h1>
            <?= $this->render('judgedetails', [
              'model' => $model,
            ]) ?>
            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
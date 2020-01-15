<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use frontend\models\JudgmentMast;

//$this->params['breadcrumbs'][] = $this->title;
    $gender_options = [
        'M' => 'Male',
        'F' => 'Female'
    ];
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
                        <div class="box-v2 box-info">
                            <div class="box-header with-border box-header-custom">
                                <div class="row">
                                    <div class="col-md-12 align-center">
                                        <span class="profile-title">Profile</span>
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <div class="col-md-5 col-xs-12">
                                    <div class="row">
                                        <div class="col-md-12 profile-image">
                                            <?php 
                                                 $path = Yii::$app->homeUrl . 'frontend/web/images/uploads';
                                                 $image = $model->user_pic;
                                                 if($image==""){
                                                 $image = "profile.jpg";
                                                  }
                                                ?>
                                <img src="<?php echo $img = $path.'/'.$image ; ?>" class="profile-pic">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 profile-description align-center" style="padding-top: 50px;">
                                             
                                        </div>
                                    </div>
                                </div>

                                 <div class="col-md-7 col-xs-12 profile-detail">
                                    <div class="row profile-detail-section">
                                        <div class="col-md-4 profile-detail-label">First Name</div>
                                        <div class="col-md-8 profile-detail-text"><?=$model->first_name?></div>
                                    </div>
                                    
                                    <div class="row profile-detail-section">
                                        <div class="col-md-4 profile-detail-label">Last Name</div>
                                        <div class="col-md-8 profile-detail-text"><?=$model->last_name?></div>
                                    </div>
                                    
                                    <div class="row profile-detail-section">
                                        <div class="col-md-4 profile-detail-label">Gender</div>
                                        <div class="col-md-8 profile-detail-text"><?= array_key_exists(strtoupper($model->gender), $gender_options) ? $gender_options[strtoupper($model->gender)] : 'Not-Set'?></div>
                                    </div>


                                    <div class="row profile-detail-section">
                                        <div class="col-md-4 profile-detail-label">DOB</div>
                                        <div class="col-md-8 profile-detail-text"><?= (new \DateTime($model->dob))->format('d-m-Y')?></div>
                                    </div>
                                    
                                    <div class="row profile-detail-section">
                                        <div class="col-md-4 profile-detail-label">Phone 1</div>
                                        <div class="col-md-8 profile-detail-text"><?=!empty($model->landline_1) ? $model->landline_1 : '-NA-' ?></div>
                                    </div>
                                    
                                    <div class="row profile-detail-section">
                                        <div class="col-md-4 profile-detail-label">Phone 2</div>
                                        <div class="col-md-8 profile-detail-text"><?=!empty($model->landline_2) ? $model->landline_2 : '-NA-' ?></div>
                                    </div>

                                    <div class="row profile-detail-section">
                                        <div class="col-md-4 profile-detail-label">Mobile 1</div>
                                        <div class="col-md-8 profile-detail-text"><?=$model->mobile_1?></div>
                                    </div>
                                    
                                    <div class="row profile-detail-section">
                                        <div class="col-md-4 profile-detail-label">Mobile 2</div>
                                        <div class="col-md-8 profile-detail-text"><?=!empty($model->mobile_2) ? $model->mobile_2 : '-NA-' ?></div>
                                    </div>
                                    <div class="col-md-4 col-md-offset-4" style="padding-top: 30px;">
                                        <?= \yii\helpers\Html::a('<span><i class="fa fa-pencil"></i></span>  Update Profile', 'step2', [
                                            'class' => 'btn theme-blue-button btn-block'
                                        ])?>
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
                


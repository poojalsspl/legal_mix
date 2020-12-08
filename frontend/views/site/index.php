<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\captcha\Captcha;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

$this->title = 'Courts Judgments';
?>
<script type="text/javascript">
        function successsearch0() {
     if(document.getElementById("textbox0").value==="") { 
            document.getElementById('srchbutton0').disabled = true; 
        } else { 
            document.getElementById('srchbutton0').disabled = false;
        }
    }
            function successsearch1() {
     if(document.getElementById("textbox1").value==="") { 
            document.getElementById('srchbutton1').disabled = true; 
        } else { 
            document.getElementById('srchbutton1').disabled = false;
        }
    }
            function successsearch2() {
     if(document.getElementById("textbox2").value==="") { 
            document.getElementById('srchbutton2').disabled = true; 
        } else { 
            document.getElementById('srchbutton2').disabled = false;
        }
    }


    </script>
<!--Slider Section Start-->
<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
    
    <!-- Carousel items -->
    <div class="carousel-inner carousel-zoom">
        
        <div class="active item">
            <?=Html::img('@web/images/landing/BG4.jpg', ['class' => 'slider-image'])?>
          <div class="carousel-caption slider-caption">
              <div class="row">
                        <form role="form" id="form" name="form" novalidate="novalidate" action="/legal_mix/site/searchnew">                 
                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <div class="form-group">
                                   <input type="search" class="form-control" style="height:40px; border-radius: 38px;" id="textbox0" autocomplete="off" name="q" placeholder="Search...." onkeyup="successsearch0()">
                                     <input type="hidden" name="court_code" id="court_code" />
                                     <input type="hidden" name="advance_search" value="1" />
                                  </div>
                            </div> 
                             
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="row">
                                  <button class="btn theme-blue-button btn-block" style="height:40px; border-radius: 38px;" type="submit" id="srchbutton0" disabled> SEARCH</button>

                                </div>


                            </div>
                           
                        </form>
              </div>
             
                 
                <span class="slider-title-container">
                  <h2 class="slider-title-1"></h2>
              </span>  
             
              <span class="slider-title-container">
                  <h2 class="slider-title-2"></h2>
              </span>
              <p class="slider-description"><i><b></b></i></p>
              
          </div>
        </div>
        <div class="item">
            <?=Html::img('@web/images/landing/BG7.jpg', ['class' => 'slider-image'])?>
          <div class="carousel-caption slider-caption">
             <div class="row">
                       <form role="form" id="form" name="form" novalidate="novalidate" action="/legal_mix/site/searchnew">                         
                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="search" class="form-control" style="height:40px; border-radius: 38px;" autocomplete="off" id="textbox1" name="q" placeholder="Search...." onkeyup="successsearch1()">
                                     <input type="hidden" name="court_code" id="court_code" />
                                     <input type="hidden" name="advance_search" value="1" />
                                  </div>
                            </div> 
                             
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="row"><button type="submit" class="btn theme-blue-button btn-block" style="height:40px; border-radius: 38px;" id="srchbutton1" disabled>SEARCH</button>
                                
                                </div>                                
                            </div>
                        </form>
              </div>
              <span class="slider-title-container">
                  <h2 class="slider-title-1"></h2>
              </span>         
              <span class="slider-title-container">
                  <h2 class="slider-title-2"></h2>
              </span>
              <p class="slider-description"><i><b></b></i></p>
              
          </div>
        </div>
        <div class="item">
            <?=Html::img('@web/images/landing/slider-3_medicine_law.jpg', ['class' => 'slider-image'])?>
          <div class="carousel-caption slider-caption">
            <div class="row">
                       <form role="form" id="form" name="form" novalidate="novalidate" action="/legal_mix/site/searchnew">                          
                            <div class="col-md-10 col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <input type="search" class="form-control" style="height:40px; border-radius: 38px;" autocomplete="off" id="textbox2" name="q" placeholder="Search...." onkeyup="successsearch2()">
                                     <input type="hidden" name="court_code" id="court_code" />
                                     <input type="hidden" name="advance_search" value="1" />
                                  </div>
                            </div> 
                             
                            <div class="col-md-2 col-sm-4 col-xs-12">
                                <div class="row"><button type="submit" class="btn theme-blue-button btn-block" style="height:40px; border-radius: 38px;" id="srchbutton2" disabled>SEARCH</button></div>                                
                            </div>
                        </form>
              </div>
              <span class="slider-title-container">
                  <h2 class="slider-title-1"></h2>
              </span>
              <span class="slider-title-container">
                  <h2 class="slider-title-2"></h2>
              </span>
              <p class="slider-description"><i><b></b></i></p>
           
          </div>
        </div>
       
 
    </div>
    <!-- Carousel nav -->
    <a class="carousel-control left slider-carousel" href="#carousel" data-slide="prev">‹</a>
    <a class="carousel-control right slider-carousel" href="#carousel" data-slide="next">›</a>
</div>
<!--Slider Section End -->



    <!-- service area start -->
    <div class="service-area">
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="service-single">
                        <span class="stats-item-icon">
                            <i class="fa fa-gavel stats-icon"></i>
                        </span>
                        <h2><span class="counter"><?php echo $judgment_count->sc_judgment ;?></span></h2>
                        <p>SUPREME COURT</p>
                    </div>
                </div>
                
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="service-single">
                        <span class="stats-item-icon">
                            <i class="fa fa-gavel stats-icon"></i>
                        </span>
                        <h2><span class="counter"><?php echo $judgment_count->hc_judgment ;?></span></h2>
                        <p>HIGH COURT</p>
                    </div>
                </div>
                
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="service-single">
                        <span class="stats-item-icon">
                            <i class="fa fa-gavel stats-icon"></i>
                        </span>
                        <h2><span class="counter"><?php echo $judgment_count->tr_judgment ;?></span></h2>
                        <p>TRIBUNAL </p>
                    </div>
                </div>

                 <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="service-single">
                        <span class="stats-item-icon">
                            <i class="fa fa-folder-open stats-icon"></i>
                        </span>
                        <h2><span class="counter"><?php echo $judgment_count->totind_judgment ;?></span></h2>
                        <p>Total Judgment </p>
                    </div>
                </div>
                
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="service-single">
                        <span class="stats-item-icon">
                            <i class="fa fa-gavel stats-icon"></i>
                        </span>
                        <h2><span class="counter"><?php echo $judgment_count->fc_judgment ;?></span></h2>
                        <p>FOREIGN COURT</p>
                    </div>
                </div>
                
               
                
                <div class="col-md-2 col-sm-4 col-xs-12">
                    <div class="service-single">
                        <span class="stats-item-icon">
                            <i class="fa fa-file stats-icon"></i>
                        </span>
                        <h2><span class="counter"><?php echo $judgment_count->ba ;?></span></h2>
                        <p>BAREACT</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
    <!-- feature area start -->
<!--     <section class="feature-area ptb--100" id="feature">
        <div class="container">
            <div class="section-title">
                <p>The Unique Story</p>
                <h2>Features</h2>
                
            </div>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="ft-content">
                        <div class="ft-single">
                            <?= yii\helpers\Html::img('@web/images/landing/pricing_plan.png')?>
                            <div class="meta-content">
                                <h2>Pricing Plans</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <div class="col-md-4 hidden-sm col-xs-12">
                    <div class="ft-screen-img">
                        <?= yii\helpers\Html::img('@web/images/landing/features.png')?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="ft-content">
                        <div class="ft-single">
                            <?= yii\helpers\Html::img('@web/images/landing/search_db.png')?>
                            <div class="meta-content">
                                <h2>High End Database Search</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, iumod tempor incididunt</p>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!-- feature area end -->
   
   <!-- call-action area start -->
    <section class="" id="download">
        <div class="register">
                <div class="row register-inner">
                    <div class="col-md-6 register-left">
                          <a href="http://www.adlaw.in/" target="_blank"><img src="/legal_mix/images/landing/Register_new.png" alt=""></a>  

                    </div>
                    <div class="col-md-6 register-right">
                        <div class="row register-form">
                            <div class="col-md-12">
                                <?php
                                    $form = ActiveForm::begin([
                                        'id' => 'login-form-horizontal',
                                        'enableAjaxValidation'   => false,
                                        'type' => ActiveForm::TYPE_HORIZONTAL,
                                        'fieldConfig' => [
                                               'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
                                               'horizontalCssClasses' => [
                                                   'wrapper' => 'col-sm-12',
                                                   'error' => '',
                                                   'hint' => '',
                                               ],
                                           ],
                                    ]); 
                                ?>
                        <div class="row">
                            <div class="col-sm-4"><label><?=$model->getAttributeLabel('email')?></label></div>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'email',[
                                    'addon' => [
                                        'prepend' => [
                                            'content' => '<span class="register-form-icon"><i class="fa fa-envelope"></i></span>'
                                        ],
                                    ]
                                    ])->textInput([
                                        'disabled' => false,
                                        'placeholder' => 'Email Address'
                                ])->label(false);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><label><?=$model->getAttributeLabel('mobile_number')?></label></div>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'mobile_number',[
                                    'addon' => [
                                        'prepend' => [
                                            'content' => '<span class="register-form-icon"><i class="fa fa-mobile"></i></span>'
                                        ],
                                    ]
                                    ])->textInput([
                                        'disabled' => false,
                                        'placeholder' => 'Mobile Number'
                                ])->label(false);?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><label><?=$model->getAttributeLabel('password')?></label></div>
                            <div class="col-sm-8">
                                        <?= $form->field($model, 'password',[
                                    'addon' => [
                                        'prepend' => [
                                            'content' => '<span class="register-form-icon"><i class="fa fa-key"></i></span>'
                                        ],
                                    ]
                                    ])->passwordInput([
                                        'disabled' => false,
                                        'placeholder' => 'Password'
                                ])->label(false)?>                                    
                            </div>
                            
                        </div>
                                <div class="row">
                            <div class="col-sm-4"><label><?=$model->getAttributeLabel('password_repeat')?></label></div>
                            <div class="col-sm-8">
                                        <?= $form->field($model, 'password_repeat',[
                                    'addon' => [
                                        'prepend' => [
                                            'content' => '<span class="register-form-icon"><i class="fa fa-key"></i></span>'
                                        ],
                                    ]
                                    ])->passwordInput([
                                        'disabled' => false,
                                        'placeholder' => 'Repeat Password'
                                ])->label(false)?>                                    
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-4"><label><?=$model->getAttributeLabel('verifyCode')?></label></div>
                            <div class="col-sm-8">
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '<div class="col-md-12"><div class="col-md-6">{image}</div><div class="col-md-6">{input}</div></div>',
                                ])->label(false) ?>
                            </div>                            
                        </div>
                        <div>
                          <div class="col-sm-6">
                            <label>
                              <?= "I agree to the "?>
                              <a href="/legal_mix/articles/view?id=2">Terms of Use</a>
                            </label>
                          </div>
                          <div class="col-sm-6">
                            <?= $form->field($model, 'tnc')->checkBox(['style'=>'width:50px'])->label(false); ?>
                          </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4 col-md-offset-4">
                                <?= Html::submitButton('<span class="register-form-icon"><i class="fa fa-check"></i></span> Submit', ['class' => 'btn btn-lg btn-block theme-color-main', 'style' => 'color: #fff']) ?>
                            </div>
                        </div>
                            <?php ActiveForm::end(); ?>
                            </div>

                        </div>
                        
                    </div>
                </div>

            </div>
    </section>
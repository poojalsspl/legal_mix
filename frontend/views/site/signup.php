<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'SIGN UP';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-8 col-md-offset-2 col-sm-12 col-xs-12">
<div class="signup-box">
    <div class="login-logo theme-color-main login-custom-logo">
        <span class="login-title"><?=Html::encode($this->title)?></span>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body box-body-custom">
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
                            <div class="col-sm-3"><label><?=$model->getAttributeLabel('email')?></label></div>
                            <div class="col-sm-9">
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
                            <div class="col-sm-3"><label><?=$model->getAttributeLabel('mobile_number')?></label></div>
                            <div class="col-sm-9">
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
                            <div class="col-sm-3"><label><?=$model->getAttributeLabel('password')?></label></div>
                            <div class="col-sm-9">
                                
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
                            <div class="col-sm-3"><label><?=$model->getAttributeLabel('password_repeat')?></label></div>
                            <div class="col-sm-9">
                                        <?=$form->field($model, 'password_repeat',[
                                        'addon' => [
                                        'prepend' => [
                                            'content' => '<span class="register-form-icon"><i class="fa fa-key"></i></span>'
                                        ],
                                    ]
                                    ])->passwordInput([
                                        'disabled' => false,
                                        'placeholder' => 'Repeat Password'
                                ])->label(false);?>
                                    </div>
                                </div>
                            
                        <div class="row">
                            <div class="col-sm-3"><label><?=$model->getAttributeLabel('verifyCode')?></label></div>
                            <div class="col-sm-9">
                                <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                                    'template' => '<div class="col-md-12"><div class="col-md-3">{image}</div><div class="col-md-4">{input}</div></div>',
                                ])->label(false) ?>
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
                                
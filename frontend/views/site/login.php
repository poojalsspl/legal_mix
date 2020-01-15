<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

    use yii\helpers\Html;
    use yii\bootstrap\ActiveForm;

    $this->title = 'Login';

    $fieldOptions1 = [
        'options' => ['class' => 'form-group has-feedback'],
        //'errorOptions' => ['encode' => false],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
    ];

    $fieldOptions2 = [
        'options' => ['class' => 'form-group has-feedback'],
        //'errorOptions' => ['encode' => false],
        'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
    ];
?>



<div class="login-box">
    <div class="login-logo theme-color-main login-custom-logo">
        <span class="login-title">Login</span>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body box-body-custom">
        <p class="login-box-msg" style="padding-bottom: 20px">Please fill out the following fields to login:</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

        <?= $form
            ->field($model, 'username', $fieldOptions1)
            ->label(true)
            ->textInput() ?>

        <?= $form
            ->field($model, 'password', $fieldOptions2)
            ->label(true)
            ->passwordInput() ?>

        <div class="row">
            <div class="col-md-6 col-xs-12">
                <?= $form->field($model, 'rememberMe')->checkbox() ?>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="form-group"><?php //echo Html::a('Forgot Password', ['site/request-password-reset', 'style' => 'vertical-align: center']) ?></div>
            </div>
            <!-- /.col -->
        </div>
 <div class="row">
            <div class="col-xs-8 col-xs-offset-2">
                
                <?= Html::submitButton('LOGIN', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                
            </div><div class="col-xs-8">
                
            </div>
        </div>
        


        <?php ActiveForm::end(); ?>
    </div>
    <!-- /.login-box-body -->
</div>


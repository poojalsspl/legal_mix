<?php
namespace frontend\assets;
use yii\web\AssetBundle;
/**
 * Main frontend application asset bundle.
 */
class NewTheme extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/css_new/bootstrap.min.css',
      'css/css_new/owl.carousel.min.css',
      //'css/css_new/css/animate.min.css',
      //'css/css_new/animate-custom.css',
      //'css/css_new/css-42c1d-92080.min.css',
      
      //'css/css_new/style_registration_form.css',
      
      
    ];

    public $js = [
        'js/js_new/bootstrap.min.js',
        'js/js_new/owl.carousel.min.js',
        //'js/js_new/jquery-2.2.4.min.js',
        //'js/js_new/popper.min.js',
        
        //'js/js_new/jquery.viewport.min.js',
        //'js/js_new/hoverintent.min.js',
    ];
    public $depends = [
      //  'yii\web\YiiAsset',
      //  'yii\bootstrap\BootstrapAsset',

    ];
}




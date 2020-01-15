<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css',
        'theme/css/AdminLTE.min.css',
        'theme/css/skins/_all-skins.min.css'
        //'theme/css/AdminLTE.css',
    ];
    public $js = [
        'js/jsLib.js',
        'js/ajax-modal-popup.js',
        'theme/js/app.min.js',
        'theme/js/demo.js',
        'js/main.js',
        'js/ckeditor/ckeditor.js',
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js'
      
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

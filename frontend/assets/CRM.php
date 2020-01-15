<?php

namespace frontend\assets;
use yii\web\AssetBundle;
/**
 * Main frontend application asset bundle.
 */
class Sidebar extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      'css/site.css',
      'css/icofont.min.css',
      'css/css-7c69b-92082.css',
      'css/css-42c1d-92080.css',
      'css/css-65c5c-92080.css',
      'css/css-a1381-92078.css',
      'css/jquery-ui.theme.css',
    ];

    public $js = [
      'js/main.js',
      'js/acymailing_module.js',
      'js/js-9a8dd-92082.js',
      'js/js-ca15c-63066.js',
      'js/js-ca15c-92080.js',
      'js/jquery.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

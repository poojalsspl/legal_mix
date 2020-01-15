<?php

namespace frontend\assets;

use yii\web\AssetBundle;



/**

 * Main frontend application asset bundle.

 */

class AppAsset extends AssetBundle

{

    public $basePath = '@webroot';

    public $baseUrl = '@web';

    public $css = [

        'css/site.css',

        'css/icofont.min.css',

        'css/custom.css',
        'css/bootstrap-toggle.min.css'

      /*  't3-assets/css/css-4f6cf-92080.css',

        't3-assets/css/css-5b7f0-92080.css',

        't3-assets/css/css-5da31-92080.css',

        't3-assets/css/css-7abde-92080.css',

        't3-assets/css/css-7c69b-92082.css',

        't3-assets/css/css-7e114-92080.css',

        't3-assets/css/css-12ec7-92082.css',

        't3-assets/css/css-16d9f-92080.css',

        't3-assets/css/css-23f1d-92080.css',

        't3-assets/css/css-28c94-92082.css',

        't3-assets/css/css-42c1d-92080.css',

        't3-assets/css/css-58c8b-92082.css',

        't3-assets/css/css-65c5c-92080.css',

        't3-assets/css/css-76bbd-92080.css',

        't3-assets/css/css-79d74-92080.css',

        't3-assets/css/css-375bd-92082.css',

        't3-assets/css/css-8491c-92080.css',

        't3-assets/css/css-9419c-92082.css',

        't3-assets/css/css-45862-92080.css',

        't3-assets/css/css-80879-92078.css',

        't3-assets/css/css-a1381-92078.css',

        't3-assets/css/css-b5bfb-92082.css',

        't3-assets/css/css-c111d-92080.css',

        't3-assets/css/css-c568b-92080.css',

        't3-assets/css/css-e9a5c-92080',

        't3-assets/css/css-ecaef-92080.css',

        't3-assets/css/css-f8728-92080.css',

        'plugins/system/jagooglemap/assets/style3860.css',*/

    ];

    public $js = [

        'js/jsLib.js',
        'js/bootstrap-toggle.min.js',
        'js/ajax-modal-popup.js',
        'js/ckeditor/ckeditor.js'
        
         //'js/tinymce/tinymce.js'

       /* 't3-assets/js/js-03f4f-92074.js',

        't3-assets/js/js-4cf87-92082.js',

        't3-assets/js/js-9a8dd-92082.js',

        't3-assets/js/js-052d9-92082.js',

        't3-assets/js/js-52e0b-92082.js',

        't3-assets/js/js-394d3-92082.js',

        't3-assets/js/js-27424-92082.js',

        't3-assets/js/js-78688-92082.js',

        't3-assets/js/js-aa666-92082.js',

        't3-assets/js/js-ca15c-92080.js',

        't3-assets/js/js-ccad7-92082.js',

        't3-assets/js/js-ff9dc-92074.js',

        'plugins/system/jagooglemap/assets/markcluster.js',

        'plugins/system/jagooglemap/assets/script3860.js',*/

    ];

    public $depends = [

        'yii\web\YiiAsset',

        'yii\bootstrap\BootstrapAsset',

    ];

}


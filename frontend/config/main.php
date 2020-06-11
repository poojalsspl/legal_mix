<?php
//use \kartik\tree\Module;
//use yii\helpers\Url;
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
//'homeUrl' => 'http://localhost/legal_mix/',
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'homeUrl' => '/legal_mix/',
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        /*'mailer' => [
        'class' => 'yii\swiftmailer\Mailer',
        'viewPath' => '@common/mail',
        'transport' => [
        'class' => 'Swift_SmtpTransport',
        'host' =>  'smtp.gmail.com',
        'username' => '',
        'password' => '',
        'port' => '587',
        'encryption' => 'tls',*/
        /*'streamOptions' => [ 
            'ssl' => [ 
                'allow_self_signed' => true,
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ]*/
         /*],
         'useFileTransport' => false,
         ],*/
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '/legal_mix',
        ],
       /* 'urlManager'=>[
            'scriptUrl'=>'/legal_mix/',
        ],*/
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
         'urlManager' => [
            'baseUrl' => '/legal_mix',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
       /* 'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [*/
//	    '<action:(.*)>' => 'site/<action>',
          //'<controller:(site)>/<action:(detail)>/<id:\w+>' => '<controller>/<action>',
          // '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>'   
          //'<controller:(site)\w+>/<action:(detail)\w+>/<id:\d+>'=>'<controller>/<action>'      
       /*     ],
        ],*/
    ],
    'params' => $params,
];

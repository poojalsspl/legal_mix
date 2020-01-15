<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
	 'admin' => [
				'class' => 'mdm\admin\Module',            
			],
	'rbac' =>  [
        'class' => 'johnitvn\rbacplus\Module',	
    ],

   'gridview' =>  [
        'class' => '\kartik\grid\Module'
        // enter optional module parameters below - only if you need to  
        // use your own export download action or custom translation 
        // message source
        // 'downloadAction' => 'gridview/export/download',
        // 'i18n' => []
    ]
],

    'components' => [
		'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'sphinx' => [
            'class' => 'yii\sphinx\Connection',
            'dsn' => 'mysql:host=174.138.188.234;port=9306;',
            'username' => '',
            'password' => '',
        ],
        'i18n' => [
            'translations' => [
               'backend*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                //'basePath' => '@app/messages',
                //'sourceLanguage' => 'en-US',
                    //'fileMap' => [
                     //  'app' => 'app.php',
                    //   'app/error' => 'error.php',
                    // ],
                 ],
             ],
          ],
    ],
	
/*	 'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
          //  'site/*',
        //    'admin/*',
         //   'some-controller/some-action',
            // The actions listed here will be allowed to everyone including guests.
            // So, 'admin/*' should not appear here in the production, of course.
            // But in the earlier stages of your development, you may probably want to
            // add a lot of actions here until you finally completed setting up rbac,
            // otherwise you may not even take a first step.
        ]
    ],*/
];

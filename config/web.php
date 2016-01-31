<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'dztHh51rF-ljwcWvAemRwT1wdVI3_mY_',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        'i18n' => [
	        'translations' => [
	            '*' => [
	                'class' => 'yii\i18n\PhpMessageSource',
	                'basePath' => '@app/messages',
	                'sourceLanguage' => 'en',
	                'language' => 'es',
	                'fileMap' => [
	                    //'main' => 'main.php',
	                ],
	            ],
	        ],
	    ],/**/
        'urlManager' => [
	        'class' => 'yii\web\UrlManager',
	        'showScriptName' => false,
	        'enablePrettyUrl' => true,
	        'rules' => array(
	                //'<module:\w+>/<controller:\w+>/<id:\d+>' => '<module>/<controller>/ver',
	                //'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>' => '<module>/<controller>/<action>',
	                //'<module:\w+>/<controller:\w+>/<action:\w+>' => '<module>/<controller>/<action>',
	        ),
        ],/**/
        'authManager' => [
			'class' => 'yii\rbac\DbManager',
		],
    ],
    'modules' => [
	    'user' => [
	        'class' => 'dektrium\user\Module',
			'admins' => ['fernandrez'],
	        'controllerMap' => [
                'admin' => 'app\controllers\user\AdminController',
                'profile' => 'app\controllers\user\ProfileController',
            ],
	    ],
	    'rbac' => [
	        'class' => 'dektrium\rbac\Module',
	    ],
	    'geo' => [
            'class' => 'app\modules\geo\Module',
        ],
	    'registro' => [
            'class' => 'app\modules\registro\Module',
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',      
        'allowedIPs' => ['127.0.0.1', '::1'],  
        'generators' => [ //here
            'model' => [ // generator name
                'class' => 'yii\gii\generators\model\Generator', // generator class
                'templates' => [ //setting for out templates
                    'model-behaviors' => '@app/generators/templates/model-behaviors',
                ]
            ],
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'crud-es' => '@app/generators/templates/crud-es', // template name => path to template
                ]
            ]
        ],
    ];
}

return $config;

<?php

use kartik\datecontrol\Module;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'premenag',
    'name' => $params['nama_sistem'],
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log',],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'layout' => 'left-menu',
        ],
        'profile' => [
            'class' => 'app\modules\profile\Profile',
        ],
        'api' => [
            'class' => 'app\modules\api\Api',
        ],
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        'datecontrol' => [
            'class' => 'kartik\datecontrol\Module',
            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                Module::FORMAT_DATE => 'dd MMMM yyyy',
                Module::FORMAT_TIME => 'HH:mm:ss',
                Module::FORMAT_DATETIME => 'dd MMMM yyyy HH:mm:ss',
            ],
            'saveTimezone' => 'Asia/Jakarta',
            'displayTimezone' => 'Asia/Jakarta',
            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
                Module::FORMAT_TIME => 'php:U',
                Module::FORMAT_DATETIME => 'php:U',
            ],


            // automatically use kartik\widgets for each of the above formats
            'autoWidget' => true,

        ]

    ],
    'language' => 'id-ID',
    'sourceLanguage' => 'id-ID',
    'timezone' => 'Asia/Jakarta',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'Wk32V3NLEV5Lds_bKTYD9fvHpzAyQ_X6',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
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
        'db' => $db,
        'formatter' => [
            'locale' => 'id_ID',
            'decimalSeparator' => ',',
            'thousandSeparator' => '.',

        ],
        'authManager' => [
            'class' => 'yii\rbac\PhpManager', // or use 'yii\rbac\DbManager'
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            // Disable r= routes
            'enablePrettyUrl' => true,
            'rules' => [
//                ['class' => 'common\helpers\UrlRule', 'connectionID' => 'db', /* ... */],
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

            ],
        ],
        'assetManager' => [
//            'linkAssets' => true,
            'appendTimestamp' => YII_ENV_PROD ? true : false,
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => '@app/assets/metronic/assets',

                    'css' => ['css/demo1/style.bundle.css']
                ],
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => $params['maps_api'],
                        'language' => 'id',
                        'version' => '3.1.18'
                    ]
                ],
            ]
        ],
        'as access' => [
            'class' => 'mdm\admin\components\AccessControl',
            'allowActions' => [
                'site/*',
                'admin/*',
                '*/*'
                // The actions listed here will be allowed to everyone including guests.
                // So, 'admin/*' should not appear here in the production, of course.
                // But in the earlier stages of your development, you may probably want to
                // add a lot of actions here until you finally completed setting up rbac,
                // otherwise you may not even take a first step.
            ]
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.2.2', '192.168.10.1'], // adjust this to your needs
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', '192.168.2.2', '192.168.10.1'], // adjust this to your needs
        'generators' => [ // HERE
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'metronic' => '@app/templates/crud/metronic',
                ]
            ]
        ],
    ];
}

return $config;

<?php
/**
 * Project: premenag.
 * @author Adryan Eka Vandra <adryanekavandra@gmail.com>
 *
 * Date: 11/3/2019
 * Time: 7:20 PM
 */

return [
    'urlManager' => [
        'class' => 'yii\web\UrlManager',
        // Disable index.php
        'showScriptName' => false,
        // Disable r= routes
        'enablePrettyUrl' => true,
        'enableStrictParsing' => false,
        'rules' => [
            ['class' => 'yii\rest\UrlRule', 'controller' => 'golongan'],
            ['class' => 'yii\rest\UrlRule', 'controller' => 'auth'],
        ],
    ],
    'request' => [
        'class' => '\yii\web\Request',
        'enableCookieValidation' => false,
        'parsers' => [
            'application/json' => 'yii\web\JsonParser',
        ],
    ],

    'response' => [
        'class' => 'yii\web\Response',
        'on beforeSend' => function ($event) {
            $response = $event->sender;
            if ($response->data !== null && Yii::$app->request->get('suppress_response_code')) {
                $response->data = [
                    'success' => $response->isSuccessful,
                    'data' => $response->data,
                ];
                $response->statusCode = 200;
            }
        },
        'formatters' => [
            \yii\web\Response::FORMAT_JSON => [
                'class' => 'yii\web\JsonResponseFormatter',
                'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                // ...
            ],
        ],
        'format' => \yii\web\Response::FORMAT_JSON,


    ],
    'user' => [
        'class' => 'yii\web\User',
        'identityClass' => 'app\models\User',
        'enableSession' => false,
        'loginUrl' => null,
    ],

];

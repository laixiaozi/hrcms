<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@iview' => '@app/themes/iview',
        '@mui'  => '@app/themes/mui',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'fn6oGyuLlDAhQ6yXcB1hnxJLiQ25f0YU',
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                //测试正则匹配
                '<controller:(site|post)>/<action:(index|test)>/<id:\d+>' => '<controller>/<action>',
                [
                    'pattern' => 'site/<id:\d+>/<tag>',
                    'route' => 'site/test',
                    'defaults' => ['id' => 0, 'tag' => ''],
                ],
                'POST site/test/<id:\d+>' => 'site/test',

                //配置generate
                'generate/<action>' => 'generate/default/<action>',
                'generate/curl-get/<url:((http\:\/\/)|(https\:\/\/))?\w+(\.\w+)+((\/\w+)+|(\/\w+)?)>' => 'generate/default/curl-get',
                'generate/<action>/<widgetName:\w+>' => 'generate/default/<action>',
                [
                    'pattern' => 'generate/widget/<widgetName:\w+>/<tplType:\d+>',
                    'route' => 'generate/default/widget',
                    'defaults' => [
                        'widgetName' => '',
                        'tplType' => 0,
                    ],
                ],
                //其他路由

            ], //end rules

        ], //end urlmanager

        //主题配置
        'view' => [
            'theme' => [
                'basePath' => '@app/themes/mui',
                'baseUrl' => '@web/themes/mui',
                'pathMap' => [
                    '@app/views' => '@app/themes/mui',
                ],
            ],
        ],

    ],
    //加载模块
    'modules' => [
        'generate' => [
            'class' => 'app\modules\generate\modules',
        ]
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['192.168.3.205', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['192.168.3.205', '::1'],
    ];
}

return $config;

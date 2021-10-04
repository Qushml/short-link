<?php

$params = require dirname(__DIR__, 2) . '/config/params.php';

return [
    'id' => 'short-link',
    'name' => 'Short link project',
    'basePath' => dirname(__DIR__, 2),
    'bootstrap' => ['log'],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'frontendUrlManager' => function () use ($params) {
            $component = require dirname(__DIR__,2) . '/config/urlManager.php';
            $component['baseUrl'] = $params['hostInfo'];
            return Yii::createObject($component);
        },
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'v1/link',
                    'prefix' => 'api',
                    'pluralize' => false,
                    'extraPatterns' => [
                        'POST create' => 'create',
                        'GET <hash>' => 'view',
                    ]
                ],
            ],
        ],
        'db' => require dirname(__DIR__, 2) . "/config/db.php",
    ],
    'params' => $params,
    'modules' => [
        'v1' => [
            'class' => 'app\api\modules\v1\Module',
            'basePath' => '@app/api/modules/v1',
        ]
    ],

];
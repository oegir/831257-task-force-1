<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@imgPath'   => '/img',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
	        '//' => '/',
                'tasks' => 'tasks/index',
                'task/<id:\d+>' => 'tasks/view',
                'users' => 'users/index',
                'user/<id:\d+>' => 'users/view',
            ],
        ],
    ],
    'language' => 'ru-RU',
    'sourceLanguage' => 'ru-RU',
];

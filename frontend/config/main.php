<?php
use yii\i18n\DbMessageSource;

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', '\frontend\config\SetUp'],
    'controllerNamespace' => 'frontend\controllers',
    'language' => 'ru-RU',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl'=>''
        ],
        'user' => [
            'identityClass' => 'src\entities\User',
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
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                [
                    'pattern' => 'krediti/<alias:[\w\-]+>',
                    'route' =>'company/company',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => 'vse-kompanii',
                    'route' =>'company/vse-kompanii',
                    'suffix' => '.html'
                ],
                [
                    'pattern' => 'amp/<alias:.+>',
                    'route' => 'page/landing-amp',
                    'encodeParams' => false,
                    'suffix' => '.html'
                ],
                [
                    'pattern' => 'blog',
                    'route' => 'blog/blog',
                    'encodeParams' => false,
                    'suffix' => '.html'
                ],
                [
                    'pattern' => '<alias:.+>',
                    'route' => 'page/landing',
                    'encodeParams' => false,
                    'suffix' => '.html'
                ],
                '<_a:about>' => 'site/<_a>',
                'contact' => 'contact/index',
                'signup' => 'auth/signup/signup',
                'signup/<_a:[\w-]+>' => 'auth/signup/<_a>',
                '<_a:login|logout>' => 'auth/auth/<_a>',
                '<_c:[\w\-]+>' => '<_c>/index',
                '<_c:[\w\-]+>/<id:\d+>' => '<_c>/view',
                '<_c:[\w\-]+>/<_a:[\w-]+>' => '<_c>/<_a>',
                '<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_c>/<_a>',
            ],
        ],
        'i18n' => [
            'translations' => [
                'main' => [
                    'class' => DbMessageSource::className(),
                    'sourceLanguage' => 'ru-RU',
                    'enableCaching' => true,
                    'cachingDuration' => 10,
                    'forceTranslation' => true,
                ],
            ],
        ],
        'assetManager' => [
            'appendTimestamp' => true,
        ],
        'recaptcha' => [
            'class' => 'recaptcha\ReCaptchaComponent',
            'siteKey' => '6LcAgDgUAAAAAJ5b9RKGDADYlY7juZdMOBMR9Gbg',
            'secretKey' => '6LcAgDgUAAAAAOg6y-y4KmoJYZ9nZfQwyUHY6zL3',
        ],
    ],
    'params' => $params,
];

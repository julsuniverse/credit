<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases'=>[
        '@bower'=>'@vendor/bower-asset',
        '@npm'=>'@vendor/npm-asset'
    ],
    'bootstrap'=>['\common\bootstrap\SetUp'],
    'language' => 'ru-RU',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\MemCache',
            'useMemcached' => true,
        ],
    ],
];

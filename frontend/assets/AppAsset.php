<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        //'css/site.css',
        'css/jquery-ui.min.css',
        'css/styles.css',
        'css/font-awesome.min.css',
        'css/landing.css',
    ];
    public $js = [
        'js/cj.js',
        'js/jquery-ui.min.js',
        'js/jquery.ui.touch-punch.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',

    ];
}

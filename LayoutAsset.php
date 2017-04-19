<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class LayoutAsset extends AssetBundle
{
    public $sourcePath = '@yuncms/admin/resources/assets';

    public $css = [

        //SmartAdmin Styles : Caution! DO NOT change the order
        'css/smartadmin-production-plugins.min.css',
        'css/smartadmin-production.min.css',
        'css/smartadmin-skins.min.css',

        //SmartAdmin RTL Support
        'css/smartadmin-rtl.min.css',
        'css/style.css',
        // GOOGLE FONT
        'css/open-sans.css',
        //'http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700',
    ];

    public $js = [
        'js/app.config.js',
        'js/plugins/jquery-touch/jquery.ui.touch-punch.min.js',
        'js/notification/SmartNotification.min.js',
        'js/smartwidgets/jarvis.widget.min.js',
        'js/plugins/msie-fix/jquery.mb.browser.min.js',
        'js/plugins/fastclick/fastclick.min.js',
        'js/app.js',
        'js/style.js',
        'js/speech/voicecommand.min.js',
    ];

    public $depends = [
        'yuncms\admin\assets\PaceAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapPluginAsset',
        'xutl\fontawesome\Asset',
        'yii\jui\JuiAsset',
        'yii\web\YiiAsset',

    ];
}
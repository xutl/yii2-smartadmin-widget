<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\assets;

use yii\web\AssetBundle;

class IconpIckerAsset extends AssetBundle
{
    public $sourcePath = '@yuncms/admin/resources/assets';

    /**
     * 发布参数
     *
     * @var array
     */
    public $cssOptions = ['media' => 'screen'];

    /**
     * @inheritdoc
     */
    public $js = [
        'js/plugins/bootstrap-iconpicker/js/iconset/iconset-glyphicon.min.js',
        'js/plugins/bootstrap-iconpicker/js/iconset/iconset-fontawesome-4.2.0.min.js',
        'js/plugins/bootstrap-iconpicker/js/bootstrap-iconpicker.min.js',
    ];
    public $css = [
        'js/plugins/bootstrap-iconpicker/css/bootstrap-iconpicker.min.css',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'xutl\fontawesome\Asset',
    ];
}
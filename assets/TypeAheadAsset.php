<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\assets;

use yii\web\AssetBundle;

/**
 * TypeAheadPluginAsset
 * @package backend
 */
class TypeAheadAsset extends AssetBundle
{

    public $sourcePath = '@yuncms/admin/resources/assets';

    public $css = [
        'js/plugins/bootstrap-typeahead/css/bootstrap-typeahead.css',
    ];

    public $js = [
        'js/plugins/bootstrap-typeahead/js/typeahead.bundle.min.js',
    ];

    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];
}
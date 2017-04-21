<?php
namespace yuncms\admin\assets;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the [jQuery TreeGrid plugin library](https://github.com/maxazan/jquery-treegrid)
 *
 * @author Leandro Gehlen <leandrogehlen@gmail.com>
 */
class TreeGridAsset extends AssetBundle {

    public $sourcePath = '@yuncms/admin/resources/assets';

    public $js = [
        'js/plugins/jquery-treegrid/js/jquery.treegrid.min.js',
    ];

    public $css = [
        'js/plugins/jquery-treegrid/css/jquery.treegrid.css',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];

} 
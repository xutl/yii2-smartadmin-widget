<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yii\jui;

use yuncms\admin\assets\LayoutAsset;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class JuiAsset extends LayoutAsset
{
    public $js = [
        'js/libs/jquery-ui-1.10.3.min.js',
    ];

    public $css = [];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
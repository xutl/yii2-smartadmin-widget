<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yii\web;

use yuncms\admin\assets\LayoutAsset;
/**
 * This asset bundle provides the [jQuery](http://jquery.com/) JavaScript library.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class JqueryAsset extends LayoutAsset
{

    public $css = [];
    public $js = [
        'js/libs/jquery-2.1.1.min.js',
    ];
    public $depends = [];
}
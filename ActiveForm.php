<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\widgets;

use Yii;
use yii\helpers\Html;

/**
 * A Bootstrap 3 enhanced version of [[\yii\widgets\ActiveForm]].
 *
 * @see ActiveField for details on the [[fieldConfig]] options
 * @see http://getbootstrap.com/css/#forms
 * @author Michael Härtl <haertl.mike@gmail.com>
 * @since 2.0
 */
class ActiveForm extends \yii\bootstrap\ActiveForm
{

    /**
     * @var string the default field class name when calling [[field()]] to create a new field.
     * @see fieldConfig
     */
    public $fieldClass = 'yuncms\admin\widgets\ActiveField';

    /**
     * @inheritdoc
     */
    public function init()
    {
        Html::addCssClass($this->options, 'smart-form');
        parent::init();
    }

    /**
     * @inheritdoc
     * @return ActiveField the created ActiveField object
     */
    public function field($model, $attribute, $options = [])
    {
        return parent::field($model, $attribute, $options);
    }
}
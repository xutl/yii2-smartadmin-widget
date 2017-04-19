<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */
namespace yuncms\admin\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\ArrayHelper;
use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Class SideBar
 * @package backend\widgets
 */
class SideBar extends Widget
{
    /**
     * @var array the HTML attributes for the widget container tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var array list of items in the nav widget. Each array element represents a single
     * menu item which can be either a string or an array with the following structure:
     * - label: string, required, the nav item label.
     * - url: optional, the item's URL. Defaults to "#".
     * - visible: boolean, optional, whether this menu item is visible. Defaults to true.
     * - linkOptions: array, optional, the HTML attributes of the item's link.
     * - options: array, optional, the HTML attributes of the item container (LI).
     * - active: boolean, optional, whether the item should be on active state or not.
     * - items: array|string, optional, the configuration array for creating a [[Dropdown]] widget,
     *   or a string representing the dropdown menu. Note that Bootstrap does not support sub-dropdown menus.
     *   If a menu item is a string, it will be rendered directly without HTML encoding.
     */
    public $items = [];
    /**
     * @var boolean whether the nav items labels should be HTML-encoded.
     */
    public $encodeLabels = true;
    /**
     * @var boolean whether to automatically activate items according to whether their route setting
     * matches the currently requested route.
     * @see isItemActive
     */
    public $activateItems = true;
    /**
     * @var boolean whether to activate parent menu items when one of the corresponding child menu items is active.
     */
    public $activateParents = true;
    /**
     * @var string the route used to determine if a menu item is active or not.
     * If not set, it will use the route of the current request.
     * @see params
     * @see isItemActive
     */
    public $route;
    /**
     * @var array the parameters used to determine if a menu item is active or not.
     * If not set, it will use `$_GET`.
     * @see route
     * @see isItemActive
     */
    public $params;


    /**
     * 初始化
     */
    public function init()
    {
        parent::init();
        if ($this->route === null && Yii::$app->controller !== null) {
            $this->route = Yii::$app->controller->getRoute();
        }
        if ($this->params === null) {
            $this->params = Yii::$app->request->getQueryParams();
        }
    }

    /**
     * 执行
     */
    public function run()
    {
        $items = $this->renderItems($this->items);
        return Html::tag('nav', $items, $this->options);
    }

    /**
     * 渲染所以项目
     * @param $items
     * @return null|string
     * @throws InvalidConfigException
     */
    public function renderItems($items)
    {
        if (is_string($items)) {
            return $items;
        }
        $lines = [];
        foreach ($items as $item) {
            if (is_string($item)) {
                return $item;
            }
            if (!isset ($item['label'])) {
                throw new InvalidConfigException ("The 'label' option is required.");
            }
            $encodeLabel = isset ($item['encode']) ? $item['encode'] : $this->encodeLabels;
            $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];
            $label = Html::tag('span', $label, ['class' => 'menu-item-parent']);
            $label = isset ($item['icon']) ? Html::tag('i', '', ['class' => 'fa fa-lg fa-fw ' . $item['icon']]) . ' ' . $label : $label;
            $label = isset ($item['badge']) ? $label . ' ' . $item['badge'] : $label;
            $options = ArrayHelper::getValue($item, 'options', []);
            $subItems = ArrayHelper::getValue($item, 'items');
            $url = ArrayHelper::getValue($item, 'url', '#');
            $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);
            if (isset ($item['active'])) {
                $active = ArrayHelper::remove($item, 'active', false);
            } else {
                $active = $this->isItemActive($item);
            }
            //判断是否有子菜单
            if ($subItems !== null && is_array($subItems)) {
                if ($this->activateItems) {
                    $subItems = $this->isChildActive($subItems, $active);
                    if ($active) { //如果被激活则父菜单是打开状态
                        Html::addCssClass($options, 'open');
                    }
                }
                $subItems = $this->renderItems($subItems);
            }
            if ($this->activateItems && $active) {//无子菜单则激活当前菜单
                Html::addCssClass($options, 'active');
            }
            if (isset ($item['visible']) && !$item['visible']) {
                continue;
            }
            if ($subItems == null) {
                Html::removeCssClass($options, 'open');
            }
            $lines[] = Html::tag('li', Html::a($label, $url, $linkOptions) . $subItems, $options);
        }
        if (empty($lines)) {
            return null;
        }
        return Html::tag('ul', implode("\n", $lines));
    }

    /**
     * 递归检查是否有子菜单被激活
     *
     * @param array $items @see items 菜单数组
     * @param boolean $active should the parent be active too
     * @return array @see items
     */
    protected function isChildActive($items, &$active)
    {
        foreach ($items as $i => $child) {
            if (ArrayHelper::remove($items[$i], 'active', false) || $this->isItemActive($child)) {
                Html::addCssClass($items[$i]['options'], 'active');
                if ($this->activateParents) {
                    $active = true;
                }
            }
            if (isset($child['items']) && is_array($child['items'])) {
                $child['items'] = $this->isChildActive($child['items'], $active);
            }
        }
        return $items;
    }

    /**
     * 检查是否有活动的菜单项。
     * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
     * When the `url` option of a menu item is specified in terms of an array, its first element is treated
     * as the route for the item and the rest of the elements are the associated parameters.
     * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
     * be considered active.
     *
     * @param array $item the menu item to be checked
     * @return boolean whether the menu item is active
     */
    protected function isItemActive($item)
    {
        if (isset ($item['url']) && is_array($item['url']) && isset ($item['url'][0])) {
            $route = $item['url'][0];
            if ($route[0] !== '/' && Yii::$app->controller) {
                $route = Yii::$app->controller->module->getUniqueId() . '/' . $route;
            }
            if (ltrim($route, '/') !== $this->route) {
                return false;
            }
            unset ($item['url']['#']);
            if (count($item['url']) > 1) {
                foreach (array_splice($item['url'], 1) as $name => $value) {
                    if ($value !== null && (!isset ($this->params[$name]) || $this->params[$name] != $value)) {
                        return false;
                    }
                }
            }
            return true;
        }
        return false;
    }
}
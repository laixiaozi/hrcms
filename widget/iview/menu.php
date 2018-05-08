<?php

namespace app\widget\iview;

use yii\base\widget;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * 一个菜单组件
 * 支持的事件
 * on-select  选择菜单（MenuItem）时触发        返回name
 *  on-open-change  当 展开/收起 子菜单时触发    当前展开的 Submenu 的 name 值数组
 * $demoMenu = array(
 * ['name' => 'required', 'text' => '测试', 'icon' => 'leaf'],
 * ['name' => 'required2', 'text' => '测试22', 'icon' => 'heart'],
 * ['name' => 'required3', 'text' => '测试22', 'icon' => 'heart' , 'title' => '子菜单标题', 'items' => [
 * ['name' => 'required2-1', 'text' => '测试22', 'icon' => 'heart'],
 * ['name' => 'required2-2', 'text' => '测试22', 'icon' => 'heart'],
 * ['name' => 'required2-3', 'text' => '测试22', 'icon' => 'heart'],
 * ],
 * ],
 * );
 *   <div id="menu">
 * <?= menu::widget(['menuData' => $demoMenu, 'event' => 'on-select', 'eventName' => 'func']) ?>
 * </div>
 */
class Menu extends widget
{

    public $mode;  //菜单类型，可选值为 horizontal（水平） 和 vertical（垂直）

    public $theme;  //主题，可选值为 light、dark、primary，其中 primary 只适用于 mode="horizontal"

    public $active_name;  //激活菜单的 name 值

//    public $open_name;   //展开的 Submenu 的 name 集合

    /**
     * 垂直导航菜单，可以内嵌子菜单。
     *
     * 设置 active-name 可以选中指定的菜单，设置 open-names 可以展开指定的子菜单。
     *
     * 设置属性 accordion 可以开启手风琴模式，每次只能展开一个子菜单。
     *
     * 通过设置属性 theme 为 light、dark 可以选择主题，侧栏菜单不支持 primary 主题。
     */
    public $accordion;   //是否开启手风琴模式，开启后每次至多展开一个子菜单

    public $width;      //导航菜单的宽度，只在 mode="vertical" 时有效，如果使用 Col 等布局，建议设置为 auto

    #MenuItem props
    public $name;       //菜单项的唯一标识，必填  String | Number

    #Submenu props
//    public $submenu_name;  //子菜单的唯一标识，必填   String | Number

    # Submenu slot #
    public $title;        //子菜单标题

    #MenuGroup props
    public $menuGroup_title;  //分组标题 String  空

    public $event;

    public $eventName;

    public $el;

    public $view;

    public $eventList = array('','');

    //用户传入的菜单数据
    /**
     * 用来生成菜单的三维/二维数组。* 注意。不能是多维数组
     * array = > [
     *              ['name' => 'required' , 'text' => 'required' , 'icon'=> 'option'] //缺少事件处理,稍后补充,当前菜单为叶子菜单项,不包含子菜单
     *              ['name' => '' , 'text' => 'required' , 'icon'=> 'option' , 'items'=>
     *                    [
     *                      ['name' => 'required' , 'text' => 'required' , 'icon'=> 'option', 'callBack' => 'option'],
     *                      ['name' => 'required' , 'text' => 'required' , 'icon'=> 'option' , 'callBack' => 'option'],
     *                   ],
     *                   'title'=> 'option',
     *              ],//包含子菜单
     *
     *
     *
     *           ]
     *
     */
    public $menuData;


    public function init()
    {
        parent::init();
        if (is_null($this->mode)) {
            $this->mode = 'horizontal';
        }
        if (is_null($this->theme)) {
            $this->theme = 'light';
        }
        if (is_null($this->view)) {
            $this->view = Yii::$app->getView();
        }
        if (is_null($this->el)) {
            $this->el = 'menu';
        }
    }


    public function run()
    {
        if(isset($this->menuData['debug'])){
           $this->clientJs();
           unset($this->menuData['debug']);
        }
        $menu = $this->_getMenu();
        return $menu;
    }


    private function _getMenu()
    {
        $code = '';
        if (empty($this->menuData)) {
            return '<i-menu></i-menu>';
        }

        $n = count($this->menuData);
        $code = '<i-menu mode="' . $this->mode . '"  theme="' . $this->theme . '"';
        if ($this->active_name) {
            $code .= ' active_name="' . $this->active_name . '"';
        }
        if ($this->event) {
            $code .= '  v-on:' . $this->event . '="' . $this->eventName . '"';
        }
        $code .= '>' . PHP_EOL;

        //菜单下的元素组织
        for ($i = 0; $i < $n; $i++) {
            $item = $this->menuData[$i];
            if (isset($item['items'])) {
                $code .= $this->createSubMenu($item);
            } else {
                $code .= $this->createItem($item);
            }
        }

        $code .= '</i-menu>' . PHP_EOL;
        return $code;
    }


    /**
     * 创建单个的item对象
     */
    private function createItem($item)
    {
        $code = '<menu-item name="' . $item['name'] . '"';
        $code .= '>' . PHP_EOL;
        if (isset($item['icon'])) {
            $code .= '<icon type="' . $item['icon'] . '"></icon>' . PHP_EOL;
        }
        $code .= $item['text'] . PHP_EOL;
        $code .= '</menu-item>' . PHP_EOL;
        return $code;
    }


    private function createSubMenu($item)
    {
        $subCount = count($item['items']);
        $code = '<submenu name="' . $item['name'] . '">' . PHP_EOL;


        if (isset($item['title'])) {
            $code .= '<template slot="title">';
            if (isset($item['icon'])) {
                $code .= '<icon type="' . $item['icon'] . '"></icon>' . PHP_EOL;
            }
            $code .= $item['title'];
            $code .= '</template>' . PHP_EOL;
        }

        $code .= '<menu-group>' . PHP_EOL;

        for ($s = 0; $s < $subCount; $s++) {
            $code .= $this->createItem($item['items'][$s]) . PHP_EOL;
        }
        $code .= '</menu-group>' . PHP_EOL;
        $code .= '</submenu>' . PHP_EOL;

        return $code;
    }

    public function clientJs()
    {
        $data = json_encode($this->menuData);
        $js = <<<EOD
          var MenuWidget = Vue.extend({
                 data: function(){
                    return {
                      
                    }
                 },
                 methods:{
                   func:function(e){
                     console.log(e);
                   }
                 }
          });
          new MenuWidget().\$mount('#menu');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
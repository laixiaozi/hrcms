<?php

namespace app\widget\mui;

/**
 * 列表
 * 列表是常用的UI控件，mui封装的列表组件比较简单，只需要在ul节点上添加.mui-table-view类、在li节点上添加.mui-table-view-cell类即可，如下为示例代码
 * 自定义列表高亮颜色
 *
 * 点击列表，对应列表项显示灰色高亮，若想自定义高亮颜色，只需要重写.mui-table-view-cell.mui-active即可，如下：
 *  点击变蓝色高亮
 * .
 * mui - table - view - cell . mui - active{
 * background - color: #0062CC;
 * }
 *
 * 若右侧需要增加导航箭头，变成导航链接，则只需在li节点下增加a子节点，并为该a节点增加.mui-navigate-right类即可，如下：
 *
 * 右侧添加数字角标等控件
 *
 * mui支持将数字角标、按钮、开关等控件放在列表中；mui默认将数字角标放在列表右侧显示，代码如下：
 *
 * media list（图文列表）
 *
 * 图文列表继承自列表组件，主要添加了.mui-media、.mui-media-object、.mui-media-body、.mui-pull-left/right几个类，如下为示例代码
 *
 */
use Yii;
use yii\base\Widget;

class MuiList extends Widget
{

    public $view;

    public $items;

    public function init()
    {
        parent::init();
        if (empty($this->view)) {
            $this->view = Yii::$app->getView();
        }
    }

    public function run()
    {
        return $this->getCode();
    }

    public function getCode()
    {
        $code = '<ul class="mui-table-view">' . PHP_EOL;
        if (isset($this->items) && is_array($this->items)) {
            foreach ($this->items as $item) {
                $code .= '<li class="mui-table-view-cell mui-media">' . PHP_EOL;
                if (isset($item['href'])) {
                    $code .= ' <a href="' . $item['href'] . '"  >' . PHP_EOL;
                }
                if (isset($item['icon'])) {
                    $code .= '<span class=" mui-media-object ' . $item['icon'] . '  mui-pull-left"></span>' . PHP_EOL;
                }
                if (isset($item['img'])) {
                    $code .= '<img class="mui-media-object mui-pull-left" src="' . $item['img'] . '">' . PHP_EOL;
                }
                $code .= '<div class="mui-media-body">' . PHP_EOL;
                $code .= $item['title'];
                if (isset($item['desc'])) {
                    $code .= '<p class="mui-ellipsis">' . PHP_EOL;
                    $code .= $item['desc'];
                    $code .= '</p>' . PHP_EOL;
                }
                $code .= '</div>' . PHP_EOL;
                if (isset($item['href'])) {
                    $code .= ' </a>' . PHP_EOL;
                }
                $code .= '</li>' . PHP_EOL;
            }
        }
        $code .= '</ul>' . PHP_EOL;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
          mui("body").on('click', '#showactionsheet' , function(){
              mui("#sheet1").popover('toggle'); 
          });
          
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



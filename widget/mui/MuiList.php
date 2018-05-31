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

    public $title;

    public $show;

    public $view;

    public function init()
    {
        parent::init();
        if (empty($this->title)) {
            $this->title = '测试标题';
        }
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
        $code = <<<COD
        <ul class="mui-table-view">
            <li class="mui-table-view-cell">Item 1</li>
            <li class="mui-table-view-cell">Item 2</li>
            <li class="mui-table-view-cell">Item 3</li>
        </ul>
            <ul class="mui-table-view">
            <li class="mui-table-view-cell mui-media">
                <a href="javascript:;">
                    <img class="mui-media-object mui-pull-left" src="public/img/shuijiao.jpg">
                    <div class="mui-media-body">
                        幸福
                        <p class='mui-ellipsis'>能和心爱的人一起睡觉，是件幸福的事情；可是，打呼噜怎么办？</p>
                    </div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media">
                <a href="javascript:;">
                    <img class="mui-media-object mui-pull-left" src="public/img/muwu.jpg">
                    <div class="mui-media-body">
                        木屋
                        <p class='mui-ellipsis'>想要这样一间小木屋，夏天挫冰吃瓜，冬天围炉取暖.</p>
                    </div>
                </a>
            </li>
            <li class="mui-table-view-cell mui-media">
                <a href="javascript:;">
                    <img class="mui-media-object mui-pull-left" src="public/img/cbd.jpg">
                    <div class="mui-media-body">
                        CBD
                        <p class='mui-ellipsis'>烤炉模式的城，到黄昏，如同打翻的调色盘一般.</p>
                    </div>
                </a>
            </li>
        </ul>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
         // var st = document.getElementById('showactionsheet');
         //  st.addEventListener('click',function(e){
         //       console.log('点击显示');
         //  });
          mui("body").on('click', '#showactionsheet' , function(){
              mui("#sheet1").popover('toggle'); 
          });
          
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



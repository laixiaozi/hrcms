<?php

namespace app\widget\mui;

/**
 * 弹出菜单
 */
use Yii;
use yii\base\Widget;

class MuiPopover extends Widget
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
//        $this->Js();
        return $this->getCode();
    }

    public function getCode()
    {
        //锚点打开，或者js打开
        $code = <<<COD
          <a href="#popover" id="openPopover" class="mui-btn mui-btn-primary mui-btn-block">打开弹出菜单</a>
            <div id="popover" class="mui-popover">
              <ul class="mui-table-view">
                <li class="mui-table-view-cell"><a href="#">Item1</a></li>
                <li class="mui-table-view-cell"><a href="#">Item2</a></li>
                <li class="mui-table-view-cell"><a href="#">Item3</a></li>
                <li class="mui-table-view-cell"><a href="#">Item4</a></li>
                <li class="mui-table-view-cell"><a href="#">Item5</a></li>
              </ul>
            </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
          mui("body").on('tap', '#openPopover' , function(){
              mui(".mui-popover").popover('toggle'); 
          });
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



<?php

namespace app\widget\mui;

/**
 * 单选按钮
 */
use Yii;
use yii\base\Widget;

class MuiRadio extends Widget
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
        $this->Js();
        return $this->getCode();
    }

    public function getCode()
    {
        $code = <<<COD
            <ul class="mui-table-view mui-table-view-radio">
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right">Item 1</a>
                </li>
                <li class="mui-table-view-cell mui-selected">
                    <a class="mui-navigate-right">Item 2</a>
                </li>
                <li class="mui-table-view-cell">
                    <a class="mui-navigate-right">Item 3</a>
                </li>
            </ul>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
        var list = document.querySelector('.mui-table-view.mui-table-view-radio');
          list.addEventListener('selected',function(e){
	         console.log("当前选中的为："+e.detail.el.innerText);
           });
          
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



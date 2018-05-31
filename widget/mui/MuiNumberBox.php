<?php

namespace app\widget\mui;

/**
 * 可加减数字的输入框
 */
use Yii;
use yii\base\Widget;

class MuiNumberBox extends Widget
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
            <div class="mui-numbox" data-numbox-step='10' data-numbox-min='0' data-numbox-max='100'>
              <button class="mui-btn mui-numbox-btn-minus" type="button">-</button>
              <input class="mui-numbox-input" type="number" />
              <button class="mui-btn mui-numbox-btn-plus" type="button">+</button>
            </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
          mui("body").on('click', '.mui-numbox-btn-minus' , function(){
              var v = mui(".mui-numbox").numbox().getValue(); 
              mui.toast('当前值为：' + v);
          });

            mui("body").on('click', '.mui-numbox-btn-plus' , function(){
              var v = mui(".mui-numbox").numbox().getValue(); 
              mui.toast('当前值为：' + v);
          });
          
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



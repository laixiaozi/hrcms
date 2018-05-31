<?php

namespace app\widget\mui;

/**
 * 开关组件
 */
use Yii;
use yii\base\Widget;

class MuiSwitch extends Widget
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
        //.mui-active
        $code = <<<COD
           <div class="mui-switch mui-active" id="mySwitch">
              <div class="mui-switch-handle"></div>
            </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
           var isActive = document.getElementById("mySwitch").classList.contains("mui-active");
            if(isActive){
              console.log("打开状态");
            }else{
              console.log("关闭状态");  
            }
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



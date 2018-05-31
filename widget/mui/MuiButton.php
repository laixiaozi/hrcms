<?php

namespace app\widget\mui;

/**
 * 按钮
 */
use Yii;
use yii\base\Widget;

class MuiButton extends Widget
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
            <button type="button" class="mui-btn">默认</button>
            <button type="button" class="mui-btn mui-btn-primary">蓝色</button>
            <button type="button" class="mui-btn mui-btn-success">绿色</button>
            <button type="button" class="mui-btn mui-btn-warning">黄色</button>
            <button type="button" class="mui-btn mui-btn-danger">红色</button>
            <button type="button" class="mui-btn mui-btn-royal">紫色</button> 
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



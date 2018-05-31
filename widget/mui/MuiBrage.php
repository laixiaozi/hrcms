<?php

namespace app\widget\mui;

/**
 * 数字角标，一般和九宫格列表选项卡等配合使用
 */
use Yii;
use yii\base\Widget;

class MuiBrage extends Widget
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
        $show = '';
        if ($this->show == true) {
            $show = ' mui-popover-action';
        }
        $code = <<<COD
           <span class="mui-badge">1</span>
<span class="mui-badge mui-badge-primary">12</span>
<span class="mui-badge mui-badge-success">123</span>
<span class="mui-badge mui-badge-warning">3</span>
<span class="mui-badge mui-badge-danger">45</span>
<span class="mui-badge mui-badge-purple">456</span>
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



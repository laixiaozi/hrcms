<?php

namespace app\widget\mui;

/**
 * 复选框
 */
use Yii;
use yii\base\Widget;

class MuiCheckBox extends Widget
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
            <div class="mui-input-row mui-checkbox mui-left">
              <label>checkbox左侧显示示例</label>
              <input name="checkbox1" value="Item 1" type="checkbox">
            </div>
            <div class="mui-input-row mui-checkbox ">
              <label>左侧显示示例</label>
              <input name="checkbox1" value="Item 2" type="checkbox">
            </div>
            
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



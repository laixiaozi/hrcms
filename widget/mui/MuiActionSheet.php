<?php

namespace app\widget\mui;

/**
 * 操作表
 */
use Yii;
use yii\base\Widget;

class MuiActionSheet extends Widget
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
        $show = '';
        if ($this->show == true) {
            $show = ' mui-popover-action';
        }
        $code = <<<COD
          <div id="sheet1" class="mui-popover mui-popover-bottom {$show}">
                <!-- 可选择菜单 -->
                <ul class="mui-table-view">
                  <li class="mui-table-view-cell">
                    <a href="#">菜单1</a>
                  </li>
                  <li class="mui-table-view-cell">
                    <a href="#">菜单2</a>
                  </li>
                </ul>
                <!-- 取消菜单 -->
                <ul class="mui-table-view">
                  <li class="mui-table-view-cell">
                    <a href="#sheet1"><b>取消</b></a>
                  </li>
                </ul>
          </div>
          <button class="mui-btn mui-btn-primary" id="showactionsheet">显示弹出菜单</button>
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



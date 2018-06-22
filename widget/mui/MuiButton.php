<?php

namespace app\widget\mui;

/**
 * 按钮
 * <button type="button" class="mui-btn">默认</button>
 * <button type="button" class="mui-btn mui-btn-primary">蓝色</button>
 * <button type="button" class="mui-btn mui-btn-success">绿色</button>
 * <button type="button" class="mui-btn mui-btn-warning">黄色</button>
 * <button type="button" class="mui-btn mui-btn-danger">红色</button>
 * <button type="button" class="mui-btn mui-btn-royal">紫色</button>
 */
use Yii;
use yii\base\Widget;

class MuiButton extends Widget
{


    public $inform;

    public $view;

    public function init()
    {
        parent::init();
        if (empty($this->inform)) {
            $this->inform = false;
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
        if ($this->inform) {
            $code = <<<COD
            <div class="mui-button-row">
                <button type="button" class="mui-btn " >确认</button>
                <button type="button" class="mui-btn " >取消</button>
            </div>
COD;
        } else {
            $code = '<button type="button" class="mui-btn">默认</button>';
        }

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



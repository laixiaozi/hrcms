<?php

namespace app\widget\mui;

/**
 * 蒙版遮罩
 */
use Yii;
use yii\base\Widget;

class MuiMask extends Widget
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
           <button type ='button' class=" mui-btn maskshow">打开遮罩</button>
           <button type ='button' class=" mui-btn maskhide">关闭遮罩</button>
COD;
        return $code;
    }

    /**
     *   // var st = document.getElementById('showactionsheet');
     * //  st.addEventListener('click',function(e){
     * //       console.log('点击显示');
     * //  });
     */
    public function Js()
    {
        $jscode = <<<JS
          var mask = mui.createMask(function(){
              console.log('点击关闭之后执行的操作');
          });//callback为用户点击蒙版时自动执行的回调；
          mui('body').on('tap','.maskshow' , function(){
              mask.show();//显示遮罩
          });
          mui('body').on('tap','.maskhide' , function(){
              mask.close();//关闭遮罩
          });
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



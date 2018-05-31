<?php

namespace app\widget\mui;

/**
 * 弹框
 */
use Yii;
use yii\base\Widget;

class MuiDialog extends Widget
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
           <div id="dialog">
            <button type="button" class="mui-btn mui-btn-primary">警告框</button>
            <button type="button" class="mui-btn mui-btn-success">绿色</button>
            <button type="button" class="mui-btn mui-btn-warning">黄色</button>
            <button type="button" class="mui-btn mui-btn-danger">红色</button>
         </div>
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
          mui("body").on('tap', '#dialog > .mui-btn-primary' , function(){
                mui.alert('msg:警告框' , 'title:警告' , 'btnvalue:确定' , function(){
                    console.log('点击了警告框的确定');
                });
          });
  
          mui("body").on('tap', '.mui-btn-success' , function(){
                mui.confirm('msg:警告框' ,'title:' , ['是', '否'] ,function(e){
                    console.log(e);
                });
          });
          
          mui("body").on('tap', '.mui-btn-warning' , function(){
                mui.prompt('msg:警告框','placeholder:默认值',  'title:输入框' , ['请输入', '取消'] , function(e){
                    console.log(e);
                },'div');
          });
          
          mui("body").on('tap', '.mui-btn-danger' , function(){
                mui.toast('消息框');
          });
          
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



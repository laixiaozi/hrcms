<?php

namespace app\widget\mui;

/**
 * 文本输入框
 * 所有包裹在.mui-input-row 类中的 input、textarea等元素都将被默认设置宽度属性为width: 100%; 。 将 label 元素和上述控件控件包裹在.mui-input-group中可以获得最好的排列。
 * 搜索框：在.mui-input-row同级添加.mui-input-search 类，就可以使用search控件
 * 快速删除：只需要在input控件上添加.mui-input-clear类，当input 控件中有内容时，右侧会有一个删除图标，点击会清空当前input的内容；
 * 语音输入*5+ only：为了方便快速输入，mui集成了 HTML5+的语音输入，只需要在对应input控件上添加.mui-input-speech 类，就可以在5+环境下使用语音输入
 */
use Yii;
use yii\base\Widget;

class MuiInput extends Widget
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
             <form class="mui-input-group">
                <div class="mui-input-row">
                    <label>用户名</label>
                <input type="text" class="mui-input-clear" placeholder="请输入用户名">
                </div>
                <div class="mui-input-row">
                    <label>密码</label>
                    <input type="password" class="mui-input-password" placeholder="请输入密码">
                </div>
                <div class="mui-button-row">
                    <button type="button" class="mui-btn mui-btn-primary" >确认</button>
                    <button type="button" class="mui-btn mui-btn-danger" >取消</button>
                </div>
            </form>

            <form class="mui-input-group">
                <div class="mui-input-row">
                    <label>快速删除</label>
                    <input type="text" class="mui-input-clear" placeholder="请输入内容">
                </div>
                
                <div class="mui-input-row mui-search">
                   <input type="search" class="mui-input-clear mui-input-speech " placeholder="">
                </div>
            </form>
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



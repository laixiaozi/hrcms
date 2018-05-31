<?php

namespace app\widget\mui;

/**
 * 选择器,需要用到单独的插件
 */
use Yii;
use yii\base\Widget;

class MuiPicker extends Widget
{

    public $title;

    public $show;

    public $view;

    public $cssFile;

    public $jsFile;

    public function init()
    {
        parent::init();
        if (empty($this->title)) {
            $this->title = '测试标题';
        }
        if (empty($this->view)) {
            $this->view = Yii::$app->getView();
        }
//        $this->cssFile =    '@mui/public/plugin/picker/css/mui.picker.css';
//        $this->jsFile  =    '@mui/public/plugin/picker/js/mui.picker.js';
//        $css = $this->view->registerCssFile($this->cssFile ,  ['position'=> \yii\web\View::POS_END , 'depends' =>  'app\assets\MuiAsset']);
//        $css = $this->view->registerJsFile($this->jsFile  ,  ['position'=> \yii\web\View::POS_END , 'depends' =>  'app\assets\MuiAsset']);

    }

    public function run()
    {
        $this->Js();
        return $this->getCode();
    }

    public function getCode()
    {
        $code = <<<COD
            <a href='javascript:void(0)' id="openPicker" class="mui-btn mui-btn-red">打开选择器</a>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
         var p = document.getElementById('openPicker');
         p.addEventListener('tap',function(e){
             var picker = new mui.PopPicker(); 
                 picker.setData([{value:'zz',text:'智子'}]);
                 picker.show(function (selectItems) {
                console.log(selectItems[0].text);//智子
                console.log(selectItems[0].value);//zz 
              });
         });
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



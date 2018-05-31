<?php

namespace app\widget\mui;

/**
 * 日期选择器
 */
use Yii;
use yii\base\Widget;

class MuiDatePicker extends Widget
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
            <a href='javascript:void(0)' id="openDatePicker" class="mui-btn mui-btn-red">打开日期选择器</a>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
         var p = document.getElementById('openDatePicker');
         p.addEventListener('tap',function(e){
             console.log('日期选择控件');
              var dtPicker = new mui.DtPicker(); 
              dtPicker.show(function (selectItems) { 
                console.log(selectItems.y);//{text: "2016",value: 2016} 
                console.log(selectItems.m);//{text: "05",value: "05"} 
               });
         });
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



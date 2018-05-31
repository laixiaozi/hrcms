<?php

namespace app\widget\mui;

/**
 * mui栅格化
 * 栅格系统简介：
 *栅格参数:
 * 尺寸                 超小屏幕(<400px)(Extrasmall)           小屏幕(≥400px) Small
 * 类前缀               .mui-col-xs-[1-12]                     .mui-col-sm-[1-12]
 * 列 column）数        12
 * 可嵌套                是
 * MUI 提供了非常简单实用的12列响应式栅格系统。使用时只需在外围容器上添加.mui-row，在列上添加 .mui-col-[sm|xs]-[1-12]，即可
 * 左侧:通过定义.mui-col-sm-6类在大屏(≥400px)设备上会展现为并排的两列,而.mui-col-xs-12在小屏(＜400px)设备上会覆盖之前定义的类展现为水平排
 */
use Yii;
use yii\base\Widget;

class MuiGrid extends Widget
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
            <div class="mui-row">
                <div class="mui-col-sm-8">
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right">
                            Item 1    
                        </a>
                    </li>
                </div>
                <div class="mui-col-sm-6">
                    <li class="mui-table-view-cell">
                        <a class="mui-navigate-right">
                            Item 1
                        </a>
                    </li>
                </div>
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



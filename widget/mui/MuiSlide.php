<?php

namespace app\widget\mui;

/**
 * 轮播组件
 */
use Yii;
use yii\base\Widget;

class MuiSlide extends Widget
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
        //mui-slider-indicator mui-segmented-control mui-segmented-control-inverted  横向滚动
        $code = <<<COD
          <div class="mui-slider slider" id="slidertest">
              <div class="mui-slider-group">
                <!--第一个内容区容器-->
                <div class="mui-slider-item">
                  <!-- 具体内容 -->
                  <div id="item1">
                    11111111111111
                  </div>
                  
                </div>
                <!--第二个内容区-->
                <div class="mui-slider-item">
                  <!-- 具体内容 -->
                   <div id="item2">
                    22222
                  </div>
                </div>
              </div>
           </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
          var item2Show = false,item3Show = false;//子选项卡是否显示标志
            document.querySelector('#slidertest').addEventListener('slide', function(event) {
              if (event.detail.slideNumber === 1&&!item2Show) {
                //切换到第二个选项卡
                //根据具体业务，动态获得第二个选项卡内容；
                var content = '...';
                //显示内容
                document.getElementById("item2").innerHTML = content;
                //改变标志位，下次直接显示
                item2Show = true;
              } else if (event.detail.slideNumber === 2&&!item3Show) {
                //切换到第三个选项卡
                //根据具体业务，动态获得第三个选项卡内容；
                var content = '222';
                //显示内容
                document.getElementById("item3").innerHTML = content;
                //改变标志位，下次直接显示
                item3Show = true;
              }
            });
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



<?php

namespace app\widget\mui;

/**
 *图片轮播
 */
use Yii;
use yii\base\Widget;

class MuiGallery extends Widget
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
            <div class="mui-slider" >
              <div class="mui-slider-group">
                <div class="mui-slider-item"><a href="#"><img src="public/img/cbd.jpg" /></a></div>
                <div class="mui-slider-item"><a href="#"><img src="public/img/muwu.jpg" /></a></div>
                <div class="mui-slider-item"><a href="#"><img src="public/img/shuijiao.jpg" /></a></div>
                <div class="mui-slider-item"><a href="#"><img src="public/img/yuantiao.jpg" /></a></div>
              </div>
            </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
          mui(".mui-slider").slider({interval:3000});
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



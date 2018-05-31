<?php

namespace app\widget\mui;

/**
 * 区域滚动
 */
use Yii;
use yii\base\Widget;

class MuiScroll extends Widget
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
           <div class="mui-scroll-wrapper  mui-slider-indicator mui-segmented-control mui-segmented-control-inverted">
                <div class="mui-scroll" style="height:100px;">
                                <a class="mui-control-item mui-active">
                                    推荐
                                </a>
                                <a class="mui-control-item">
                                    热点
                                </a>
                                <a class="mui-control-item">
                                    北京
                                </a>
                                <a class="mui-control-item">
                                    社会
                                </a>
                                <a class="mui-control-item">
                                    娱乐
                                </a>
                                <a class="mui-control-item">
                                    科技
                                </a>
                 </div>
        </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
           mui('.mui-scroll-wrapper').scroll({
	             deceleration: 0.0105, //flick 减速系数，系数越大，滚动速度越慢，滚动距离越小，默认值0.0006
	             scrollY: true, //是否竖向滚动
                 scrollX: false, //是否横向滚动
                 startX: 0, //初始化时滚动至x
                 startY: 0, //初始化时滚动至y
                 indicators: true, //是否显示滚动条
                 bounce: true //是否启用回弹
           });
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



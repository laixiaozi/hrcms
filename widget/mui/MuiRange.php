<?php

namespace app\widget\mui;

/**
 * 滑块
 */
use Yii;
use yii\base\Widget;

class MuiRange extends Widget
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
            <div class="mui-input-row mui-input-range">
                <label>Range</label>
                <input type="range" min="0" max="100">
            </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
           var r = mui('.mui-input-range');
           console.log(r[0]);
          
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



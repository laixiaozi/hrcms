<?php

namespace app\widget\iview;

use yii\base\widget;
use yii\helpers\Html;

//测试begin和end的使用方式
class test2 extends widget
{

    public function init()
    {
        parent::init();
        ob_start();
    }

    /**
     * $test2::begin();
     * 和
     * $test2::end();
     * 之间的内容会通过$content传到当前widget
     */
    public function run()
    {
        $content = ob_get_clean();
        return Html::encode($content);
    }


}
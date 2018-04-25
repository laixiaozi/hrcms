<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 测试一个小部件
 */
class test extends Widget
{

    public $message;

    public function init()
    {
        parent::init();
        if (is_null($this->message)) {
            $this->message = '你好,世界';
        }
    }

    public function run()
    {
        return Html::encode($this->message);
    }


}
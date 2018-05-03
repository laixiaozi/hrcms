<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 时间小部件
 */
class TimePicker extends Widget
{

    public $message;

    public $config;

    public function init()
    {
        parent::init();
        if (is_null($this->message)) {
            $this->message = '你好,世界';
        }

        if (is_null($this->config)) {
            $this->config = array();
        }
    }


    public function run()
    {
        $code = $this->createCode($this->config);
        return $code;
    }


    public function createCode($config)
    {
        $code = '<time-picker ';

        if (isset($config['type'])) {
            $code .= ' type="' . $config['type'] . '"';
        } else {
            $code .= ' type="time"';
        }

        if (isset($config['format'])) {
            $code .= ' format="' . $config['format'] . '"';
        } else {
            $code .= ' format="hh:mm:ss"';
        }

        // 通过属性 steps 可以设置时间间隔。数组的三项分别对应小时、分钟、秒。 :steps="[1, 15, 15]"
        if (isset($config['steps'])) {
            $code .= ' v-bind:steps="' . $config['steps'] . '"';
        }
        /**
         * 可以使用 disabled-hours disabled-minutes disabled-seconds 组合禁止用户选择某个时间。
         * 使用 hide-disabled-options 可以直接把不可选择的项隐藏
         *  :disabled-hours="[1,5,10]"
         * :disabled-minutes="[0,10,20]"
         */
        if (isset($config['disabled-hours'])) {
            $code .= ' v-bind:disabled-hours="' . $config['disabled-hours'] . '"';
        }

        if (isset($config['disabled-minutes'])) {
            $code .= ' v-bind:disabled-minutes="' . $config['disabled-minutes'] . '"';
        }

        if (isset($config['disabled-seconds'])) {
            $code .= ' v-bind:disabled-seconds="' . $config['disabled-seconds'] . '"';
        }

        if (isset($config['confirm'])) {
            $code .= '  ' . $config['confirm'] . ' ';
        }

        if (isset($config['hide-disabled-options'])) {
            $code .= '  ' . $config['hide-disabled-options'] . ' ';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</time-picker>' . PHP_EOL;
        return $code;
    }


}
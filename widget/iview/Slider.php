<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 滑块小部件
 */
class Slider extends Widget
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
        $code = '<Slider ';
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        if (isset($config['tip-format'])) {
            $code .= ' v-bind:tip-format="' . $config['tip-format'] . '"';
        }

        if (isset($config['range'])) {
             $code .=   '  ' .$config['range'] . ' ';  //开启双滑块
        }

        if (isset($config['disabled'])) {
            $code .=   '  ' .$config['disabled'] . ' ';  //开启双滑块
        }

        if (isset($config['show-input'])) {
            $code .=   '  ' .$config['show-input'] . ' ';  //开启双滑块
        }

        $code .= '>' . PHP_EOL;
        $code .= '</Slider>' . PHP_EOL;
        return $code;
    }


}
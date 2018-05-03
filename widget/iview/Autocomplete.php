<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 自动完成小部件
 */
class AutoComplete extends Widget
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
        $code = '<auto-complete ';
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        if (isset($config['placeholder'])) {
            $code .= ' placeholder="' . $config['placeholder'] . '"';
        }

        if (isset($config['data'])) {
            $code .= ' v-bind:data="' . $config['data'] . '"';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</auto-complete>' . PHP_EOL;
        return $code;
    }


}
<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 测试一个小部件
 */
class {className} extends Widget
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
        $code = '<i-{className} ';
        if (isset($config['icon'])) {
            $code .= ' icon="' . $config['icon'] . '"';
        }
        if (isset($config['clearable'])) {
             $code .=   '  ' .$config['clearable'] . ' ';
        }
        if (isset($config['type']) && strtolower(trim($config['type'])) == 'textarea') {
             $code .= ' type="textarea" ';
             if (isset($config['autosize'])) {
                    if (is_array($config['autosize'])) {
                           $code .= ' autosize="' . json_encode($config['autosize']) . '" ';
                    } else {
                           $code .= ' autosize="' . boolvale($config['autosize']) . '" ';
                    }
             }
        }
        $code .= '>' . PHP_EOL;
        $code .= '</i-{className}>' . PHP_EOL;
        return $code;
    }


}
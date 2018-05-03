<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 测试一个小部件
 *
 * $demoIswitch = array(
 * 'slot' => 'open', // close
 * 'size' => 'large',
 * 'icon' => 'android-close',
 * );
 */
class Iswitch extends Widget
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
        $code = '<i-switch ';
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }
        if (isset($config['size'])) {
            $code .= '  size= "' . $config['size'] . '" ';
        }

        if (isset($config['slot'])) {
            $code .= '  slot= "' . $config['slot'] . '" ';
        }
        $code .= '>' . PHP_EOL;

        if (isset($config['slot']) && isset($config['icon'])) {
            $code .= ' <icon  slot= "' . $config['slot'] . '" type= "' . $config['icon'] . '"  ></icon>';
        }
        $code .= '</i-switch>' . PHP_EOL;
        return $code;
    }


}
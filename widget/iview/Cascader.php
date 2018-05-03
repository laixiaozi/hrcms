<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;


/**
 * 级联菜单小部件
 * 级联选择对数据有较严格要求，请参照示例的格式使用data，每项数据至少包含 value、label 两项，子集为 children，以此类推。
 * value 为当前选择的数据的 value 值的数组，比如 ['beijing', 'gugong'] ，按照级联顺序依次排序，使用 v-model 进行双向绑定。
 */
class Cascader extends Widget
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
        $code = '<Cascader ';
        if (isset($config['icon'])) {
            $code .= ' icon="' . $config['icon'] . '"';
        }
        if (isset($config['clearable'])) {
            $code .= '  ' . $config['clearable'] . ' ';
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
        $code .= '</Cascader>' . PHP_EOL;
        return $code;
    }


}
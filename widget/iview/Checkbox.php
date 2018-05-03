<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * Checkbox小部件
 */
class Checkbox extends Widget
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
        if (isset($config['items']) && is_array($config['items'])) {
            $code = $this->createGroup($config['items']);
        } else {
            $code = '<Checkbox ';
            if (isset($config['icon'])) {
                $code .= ' icon="' . $config['icon'] . '"';
            }
            if (isset($config['model'])) {
                $code .= ' v-model="' . $config['model'] . '"';
            }

            if (isset($config['label'])) {
                $code .= ' label="' . $config['label'] . '"';
            }

            if (isset($config['disabled'])) {
                $code .= ' disabled';
            }

            $code .= '>' . $this->message;
            $code .= '</Checkbox>' . PHP_EOL;
        }
        return $code;
    }

    /**
     *生成分组列表
     * indeterminate 全选的时候需要用到这个属性
     */
    public function createGroup($items)
    {

        $code = '<checkbox-group';
        if (isset($items['parameters']['model']) && !is_null($items['parameters']['model'])) {
            $code .= ' v-model="' . $items['parameters']['model'] . '"   ';
        }
        $code .= '>';

        if (isset($items['list']) && is_array($items['list'])) {
            $n = count($items['list']);
            for ($i = 0; $i < $n; $i++) {
                $checkbox = $items['list'][$i];
                $code .= '<checkbox ';
                if (isset($checkbox['label'])) {
                    $code .= ' label ="' . $checkbox['label'] . '"';
                }

                if (isset($checkbox['disabled'])) {
                    $code .= ' disabled ';
                }
                $code .= '>';

                if (isset($checkbox['icon'])) {
                    $code .= '<icon type="' . $checkbox['icon'] . '"></icon>' . PHP_EOL;
                }

                if (isset($checkbox['text'])) {
                    $code .= '<span>' . $checkbox['text'] . '</span>' . PHP_EOL;
                }

                $code .= '</checkbox>' . PHP_EOL;
            }
        }

        $code .= '</checkbox-group>';

        return $code;
    }


}
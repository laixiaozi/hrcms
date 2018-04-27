<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 测试一个小部件
 * $demoRadio = array(
 * 'mode' => 'demoRadio',
 * );
 *
 * $demoRadio2 = array(
 * 'items' => array(
 * 'parameters' => array('model' => 'radioGroupmodel' , 'vertical'=> 'vertical'),
 * 'list' => array(
 * array('label' => 'radio2', 'icon' => 'social-android', 'text' => '显示的文字'),
 * array('label' => 'radio3', 'icon' => 'social-android', 'text' => '显示的文字22'),
 * ),
 * ),
 * );
 */
class Radio extends Widget
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
        //取分组列表
        if (isset($config['items']) && is_array($config['items'])) {
            $code = $this->createRadioGroup($config['items']);
        } else {
            $code = '<Radio ';
            if (isset($config['model'])) {
                $code .= ' v-model="' . $config['model'] . '"';
            }

            if (isset($config['disabled'])) {
                $code .= '  ' . $config['disabled'] . ' ';
            }

            if (isset($config['size'])) {
                $code .= ' size="' . $config['size'] . '" ';
            }
            $code .= '  type="button" ';
            $code .= '>' . $this->message;
            $code .= '</Radio>' . PHP_EOL;
        }
        return $code;
    }

    //取Radio分组列表

    /**
     * extract
     *
     * $items  = array(
     * 'parameters' => ['model' => 'modelname'],
     *     'list' => [
     *             ['label' => 'labelname', 'disabled' => 'disabled' , 'icon' => 'icon' , ]
     *      ]
     *  )
     */
    public function createRadioGroup($items)
    {
        $code = '<radio-group';

        if (isset($items['parameters']['model']) && !is_null($items['parameters']['model'])) {
            $code .= ' v-model="' . $items['parameters']['model'] . '"';
        }

        if (isset($items['parameters']['type']) && !is_null($items['parameters']['type'])) {
            $code .= ' type="' . $items['parameters']['type'] . '"';
        }

        if (isset($items['parameters']['vertical'])) {
            $code .= '  vertical  ';
        }
        if (isset($items['parameters']['size']) && !is_null($items['parameters']['size'])) {
            $code .= ' size="' . $items['parameters']['size'] . '"';
        }

        $code .= ' >' . PHP_EOL;
        if (is_array($items['list'])) {
            $total = count($items['list']);
            for ($i = 0; $i < $total; $i++) {
                $radio = $items['list'][$i];
                $code .= '<radio ';
                if (isset($radio['label']) && !is_null($radio['label'])) {
                    $code .= ' label="' . $radio['label'] . '" ';
                }
                $code .= '>' . PHP_EOL;
                if (isset($radio['icon']) && !is_null($radio['icon'])) {
                    $code .= '<icon type="' . $radio['icon'] . '"></icon>' . PHP_EOL;
                }
                $code .= '<span>' . $radio['text'] . '</span>' . PHP_EOL;
                $code .= '</radio>';
            }
        }

        $code .= '</radio-group>' . PHP_EOL;

        return $code;
    }


}
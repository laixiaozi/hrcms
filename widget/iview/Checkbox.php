<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * Checkbox小部件
 */
class Checkbox extends Widget
{

    public $message;

    public $config;

    public $view;

    public $eventList = array(
        'on-change' => array(
            'desc' => '只在单独使用时有效。在选项状态发生改变时触发，通过修改外部的数据改变时不会触发',
            'type' => 'true | false',
            'default' => '',
        ),);

    public $attributeList = array(
        'value' => array(
            'desc' => '只在单独使用时有效。可以使用 v-model 双向绑定数据',
            'type' => 'Boolean',
            'default' => 'false',
        ),
        'label' => array(
            'desc' => '只在组合使用时有效。指定当前选项的 value 值，组合会自动判断是否选中',
            'type' => 'String | Number | Boolean',
            'default' => '-',
        ),
        'disabled' => array(
            'desc' => '是否禁用当前项',
            'type' => 'Boolean',
            'default' => 'false',
        ),
        'indeterminate' => array(
            'desc' => '设置 indeterminate 状态，只负责样式控制',
            'type' => 'Boolean',
            'default' => 'false',
        ),
        'size' => array(
            'desc' => '多选框的尺寸，可选值为 large、small、default 或者不设置',
            'type' => 'String',
            'default' => '-',
        ),
        'true-value' => array(
            'desc' => '选中时的值，当使用类似 1 和 0 来判断是否选中时会很有用',
            'type' => 'String, Number, Boolean',
            'default' => 'true',
        ),
        'false-value' => array(
            'desc' => '没有选中时的值，当使用类似 1 和 0 来判断是否选中时会很有用',
            'type' => 'String, Number, Boolean',
            'default' => 'false',
        ),
    );


    public function init()
    {
        parent::init();
        if (is_null($this->message)) {
            $this->message = '你好,世界';
        }

        if (is_null($this->config)) {
            $this->config = array();
        }

        if (is_null($this->view)) {
            $this->view = Yii::$app->getView();
        }


    }


    public function run()
    {
        if (isset($this->config['debug'])) {
            $this->clientJs();
            unset($this->config['debug']);
        }
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

    public function clientJs()
    {
        $js = <<<EOD
          var Imenu = Vue.extend({
                 data: function(){
                    return {
                      {$this->config['model']}:'',
                    }
                 }
          });
          new Imenu().\$mount('#checkBox');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
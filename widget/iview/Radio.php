<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

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

    public $view;

    public $eventList = array(
        'on-change' => array(
            'desc' => '在选项状态发生改变时触发，返回当前状态。通过修改外部的数据改变时不会触发',
            'type' => '...',
            'default' => '',
        ),
    );

    public $attributeList = array(
        'value' => array(
            'desc' => '只在单独使用时有效。可以使用 v-model 双向绑定数据',
            'type' => 'Boolean',
            'default' => 'false',
        ),
        'label ' => array(
            'desc' => '只在组合使用时有效。指定当前选项的 value 值，组合会自动判断当前选择的项目',
            'type' => 'String | Number',
            'default' => '-',
        ),
        'disabled' => array(
            'desc' => '是否禁用当前项',
            'type' => 'Boolean',
            'default' => 'false',
        ),
        'size' => array(
            'desc' => '单选框的尺寸，可选值为 large、small、default 或者不设置',
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

    public function clientJs()
    {

        $js = <<<EOD
          var RadioWidget = Vue.extend({
                 data: function(){
                    return {
                      {$this->config['model']}:'',
                    }
                 },
                  methods:{
                   func:function(e){
                     console.log(e);
                   }
                 }
          });
          new RadioWidget().\$mount('#radio');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }

}
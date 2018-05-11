<?php

namespace app\widget\iview;

use yii\base\widget;
use yii\helpers\Html;
use Yii;

//测试begin和end的使用方式
class {className}  extends widget
{

    public $message;


    public $config;


    public $view;


    public $eventList = array('', '');


    public   function init()
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
        ob_start();
    }

    /**
     * $test2::begin();
     * 和
     * $test2::end();
     * 之间的内容会通过$content传到当前widget
     */
    public  function run()
    {
        $content = ob_get_clean();
        return Html::encode($content);
    }

    public   function createCode()
    {
        $code = '<i-{className} ';
        if (isset($this->config['icon'])) {
            $code .= ' icon="' . $this->config['icon'] . '"';
        }

        if (isset($this->config['clearable'])) {
            $code .= '  ' . $this->config['clearable'] . ' ';
        }

        if (isset($this->config['data'])) {
            $code .= '  v-bind:data="' . $this->config['clearable'] . '" ';
        }

        if (isset($this->config['model'])) {
            $code .= ' v-model="' . $this->config['model'] . '"';
        }

        if (isset($this->config['event'])) {
            $code .= '  v-on:' . $this->config['event'] . '="' . $this->config['eventName'] . '"';
        }


        if (isset($this->config['type']) && strtolower(trim($this->config['type'])) == 'textarea') {
            $code .= ' type="textarea" ';
            if (isset($this->config['autosize'])) {
                if (is_array($this->config['autosize'])) {
                    $code .= ' autosize="' . json_encode($this->config['autosize']) . '" ';
                } else {
                    $code .= ' autosize="' . boolvale($this->config['autosize']) . '" ';
                }
            }
        }
        $code .= '>' . PHP_EOL;
        $code .= '</i-{className}>' . PHP_EOL;
        return $code;
    }

    public  function clientJs()
    {
        $js = <<<EOD
                var {className} = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']}:[],
                              data:{$this->config['data']}
                        }
                    },
                    methods:{

                       func:function(){

                            },

                       func2:function(){


                        },

                    }
                });
        new {className}().\$mount('#{className}');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }

}
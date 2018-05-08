<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 数字输入框小部件
 */
class InputNumber extends Widget
{

    public $message;

    public $config;

    public $view;

    public $eventList = array('','');

    public function init()
    {
        parent::init();
        if (is_null($this->message)) {
            $this->message = '你好,世界';
        }

        if (is_null($this->config)) {
            $this->config = array();
        }

        if(is_null($this->view)){
            $this->view = Yii::$app->getView();
        }
    }


    public function run()
    {
        if(isset($this->config['debug'])){
           $this->clientJs();
           unset($this->config['debug']);
        }
        $code = $this->createCode($this->config);
        return $code;
    }


    public function createCode($config)
    {
        $code = '<input-number ';
        if (isset($config['icon'])) {
            $code .= ' icon="' . $config['icon'] . '"';
        }

        if (isset($config['clearable'])) {
             $code .=   '  ' .$config['clearable'] . ' ';
        }

        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        if (isset($config['event'])) {
          $code .= '  v-on:' . $config['event'] . '="' . $config['eventName'] . '"';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</input-number>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $js = <<<EOD
                var InputNumber = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']}:'',
                        }
                    },
                    methods:{

                       func:function(){

                            },

                       func2:function(){


                        },

                    }
                });
        new InputNumber().\$mount('#InputNumber');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
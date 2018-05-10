<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 测试一个小部件
 */
class {className} extends Widget
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
        $code = '<i-{className} ';
        if (isset($config['icon'])) {
            $code .= ' icon="' . $config['icon'] . '"';
        }

        if (isset($config['clearable'])) {
             $code .=   '  ' .$config['clearable'] . ' ';
        }

        if (isset($config['data'])) {
            $code .=   '  v-bind:data="' .$config['clearable'] . '" ';
        }

        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        if (isset($config['event'])) {
          $code .= '  v-on:' . $config['event'] . '="' . $config['eventName'] . '"';
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

    public function clientJs(){
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
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
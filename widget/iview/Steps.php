<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 步骤小部件
 */
class Steps extends Widget
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


    public function createCode()
    {
        $code = '<i-Steps ';
        if (isset($this->config['icon'])) {
            $code .= ' icon="' . $this->config['icon'] . '"';
        }

        if (isset($this->config['clearable'])) {
             $code .=   '  ' .$this->config['clearable'] . ' ';
        }

        if (isset($this->config['data'])) {
            $code .=   '  v-bind:data="' .$this->config['clearable'] . '" ';
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
        $code .= '</i-Steps>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $js = <<<EOD
                var Steps = Vue.extend({
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
        new Steps().\$mount('#Steps');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
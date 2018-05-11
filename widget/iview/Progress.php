<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 进度条小部件
 */
class Progress extends Widget
{

    public $message;

    public $config;

    public $view;

    public $eventList = array('', '');

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


    public function createCode()
    {
        $code = '<i-Progress ';

        if (isset($this->config['percent'])) {
            $code .= '  v-bind:percent=' . intval($this->config['percent']) . ' ';
        }


        if (isset($this->config['vertical'])) {
            $code .= '  vertical ';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</i-Progress>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Progress = Vue.extend({
                    data: function(){
                        return {
                          percent:{$this->config['percent']} ,
                        }
                    },
                    methods:{

                       func:function(){

                            },

                       func2:function(){


                        },

                    }
                });
        new Progress().\$mount('#Progress');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
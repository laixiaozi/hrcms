<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 通知小部件
 */
class Notice extends Widget
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


    public function createCode($config)
    {
        $code = '<i-button ';
        $code .= '  v-on:click="noticefunc"';
        $code .= '>' . PHP_EOL;
        $code .= $this->message;
        $code .= '</i-button>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Notice = Vue.extend({
                    data: function(){
                        return {
                        }
                    },
                    methods:{
                       noticefunc:function(){
                              this.\$Notice.{$this->config['type']}({
                                 title:"{$this->config['title']}",
                                 desc: "{$this->config['content']}",
                                 duration: 3,
                                 closable: true,
                              });
                            }, 

                       func2:function(){


                        },

                    }
                });
        new Notice().\$mount('#Notice');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
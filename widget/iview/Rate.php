<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 评分小部件
 */
class Rate extends Widget
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
        $code = '<Rate ';

        if (isset($config['allow-half'])) {
            $code .= '  allow-half ';
        }

        if (isset($config['show-text'])) {
            $code .= '  show-text ';
        }

        if (isset($config['disabled'])) {
            $code .= '  disabled ';
        }

        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</Rate>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Rate = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']}:3,
                        }
                    },
                    methods:{

                       func:function(){

                            },

                       func2:function(){


                        },

                    }
                });
        new Rate().\$mount('#Rate');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
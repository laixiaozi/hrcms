<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 头像小部件
 */
class Avatar extends Widget
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
        $code = '<Avatar ';
        if (isset($this->config['icon'])) {
            $code .= ' icon="' . $this->config['icon'] . '"';
        }

        if (isset($this->config['size'])) {
            $code .= ' size="' . $this->config['size'] . '"';
        }

        if (isset($this->config['shape'])) {
            $code .= ' shape="' . $this->config['shape'] . '"';
        }

        $code .= ' />' . PHP_EOL;
//        $code .= '</Avatar>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Avatar = Vue.extend({
                    data: function(){
                        return {
                        }
                    },
                    methods:{
                       func:function(){

                            },

                       func2:function(){


                        },

                    }
                });
        new Avatar().\$mount('#Avatar');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 提示信息小部件
 */
class ToolTip extends Widget
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
        $code = '<ToolTip ';
        if (isset($this->config['placement'])) {
            $code .= ' placement="' . $this->config['placement'] . '"';
        }

        if (isset($this->config['content'])) {
            $code .= ' content="' . $this->config['content'] . '"';
        }

        if (isset($this->config['delay'])) {
             $code .=   '  v-bind:delay="' .$this->config['delay'] . '" ';
        }

        $code .= '>' . PHP_EOL;
        $code .= $this->message;
        $code .= '</ToolTip>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $js = <<<EOD
                var ToolTip = Vue.extend({
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
        new ToolTip().\$mount('#ToolTip');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
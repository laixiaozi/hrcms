<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 树形小部件
 */
class Tree extends Widget
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
        $code = '<Tree ';
        if (isset($this->config['showCheckbox'])) {
             $code .=   '  show-checkbox ';
        }

        if (isset($this->config['multiple'])) {
            $code .=   '  multiple ';
        }

        if (isset($this->config['data'])) {
            $code .=   '  v-bind:data="data" ';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</Tree>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $jsonData  = json_encode($this->config['data']);
        $js = <<<EOD
                var Tree = Vue.extend({
                    data: function(){
                        return {
                              data:{$jsonData}
                        }
                    },
                    methods:{
                       func:function(){
                            },

                       func2:function(){
                        },
                    }
                });
        new Tree().\$mount('#Tree');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
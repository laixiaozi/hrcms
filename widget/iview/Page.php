<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 分页小部件
 */
class Page extends Widget
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
        $code = '<Page ';


        if (isset($this->config['showSizer'])) {
             $code .=   '  show-sizer ';
        }

        if (isset($this->config['showElevator'])) {
            $code .=   '  show-elevator ';
        }

        if (isset($this->config['simple'])) {
            $code .=   '  simple ';
        }


        if (isset($this->config['total'])) {
            $code .=   '  v-bind:total="' .$this->config['total'] . '" ';
        }

        if (isset($this->config['current'])) {
            $code .=   '  v-bind:current="' .$this->config['current'] . '" ';
        }
        $code .= '>' . PHP_EOL;
        $code .= '</Page>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $js = <<<EOD
                var Page = Vue.extend({
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
        new Page().\$mount('#Page');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
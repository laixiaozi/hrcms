<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * TAG小部件
 */
class Tag extends Widget
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
        $code = '<Tag ';
        if (isset($this->config['checkable'])) {
             $code .=   '  checkable ';
        }

        if (isset($this->config['color'])) {
            $code .=   ' color="'. $this->config['color'] .'" ';
        }

        if (isset($this->config['closable'])) {
            $code .=   '  closable ';
        }
//        if (isset($this->config['event'])) {
//          $code .= '  v-on:' . $this->config['event'] . '="' . $this->config['eventName'] . '"';
//        }
        $code .= '>' . PHP_EOL;
        $code .= $this->message;
        $code .= '</Tag>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $js = <<<EOD
                var Tag = Vue.extend({
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
        new Tag().\$mount('#Tag');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
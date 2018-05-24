<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 时间轴小部件
 */
class TimeLine extends Widget
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
        $code = '<TimeLine ';
        $code .= '>' . PHP_EOL;
        if(is_array($this->config['timeLineItem'])){
          $code .= '<TimeLine-Item>'. join('</TimeLine-Item><TimeLine-Item>',$this->config['timeLineItem']) .'</TimeLine-Item>'.PHP_EOL;
        }
        $code .= '</TimeLine>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $js = <<<EOD
                var TimeLine = Vue.extend({
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
        new TimeLine().\$mount('#TimeLine');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
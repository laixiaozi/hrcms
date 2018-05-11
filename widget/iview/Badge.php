<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 徽标小部件
 */
class Badge extends Widget
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
        $code = '<Badge ';

        if (isset($this->config['count'])) {
             $code .=   ' count= ' .$this->config['count'] . ' ';
        }

        if (isset($this->config['dot'])) {
            $code .=   ' dot ';
        }

        if (isset($this->config['overflowCoun'])) {
            $code .=   ' overflow-coun= ' .$this->config['overflowCoun'] . ' ';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</Badge>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $js = <<<EOD
                var Badge = Vue.extend({
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
        new Badge().\$mount('#Badge');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
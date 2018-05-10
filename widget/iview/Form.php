<?php

namespace app\widget\iview;

use yii\base\widget;
use yii\helpers\Html;
use Yii;

//测试begin和end的使用方式
class Form extends widget
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
        ob_start();
    }

    /**
     * $test2::begin();
     * 和
     * $test2::end();
     * 之间的内容会通过$content传到当前widget
     */
    public function run()
    {
        $content = ob_get_clean();
        $content = $this->createCode() . $content;
        $content .= '</i-Form>' . PHP_EOL;
        $this->clientJs();
        return $content;
    }

    public function createCode()
    {
        $code = '<i-Form ';
        if (isset($this->config['model'])) {
            $code .= ' v-bind:model="' . $this->config['model'] . '"';
        }
        $code .= '>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var FormWidget = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']}:{
                                  'name':'formName',
                              },
                              
                               
                        }
                    },
                    methods:{

                       func:function(){

                            },

                       func2:function(){


                        },
                    }
                });
        new FormWidget().\$mount('#FormWidget');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
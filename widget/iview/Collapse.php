<?php

namespace app\widget\iview;

use yii\base\widget;
use yii\helpers\Html;
use Yii;

//测试begin和end的使用方式
class Collapse extends widget
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
        $content .= '</Collapse>' . PHP_EOL;
        $this->clientJs();
        return $content;
    }

    public function createCode()
    {
        $code = '<Collapse ';
        if (isset($this->config['model'])) {
            $code .= ' v-model="' . $this->config['model'] . '"';
        }
        if (isset($this->config['accordion'])) {
            $code .= '  accordion ';
        }
        $code .= '>' . PHP_EOL;
        return $code;
    }


    public static function addPane($name, $title, $content)
    {
        $panel = '<Panel name="' . trim($name) . '" >';
        $panel .= $title;
        $panel .= '<P slot ="content">' . Html::encode($content) . '</P>';
        $panel .= '</Panel>';
        return $panel;

    }


    public function clientJs()
    {
        $js = <<<EOD
                var Collapse = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']}: '1',
                        }
                    },
                    methods:{

                       func:function(){

                            },

                       func2:function(){


                        },

                    }
                });
        new Collapse().\$mount('#Collapse');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }

}
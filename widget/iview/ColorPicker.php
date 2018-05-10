<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 颜色选择器小部件
 */
class ColorPicker extends Widget
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
        $code = '<Color-Picker ';

        if (isset($config['colors'])) {
            $code .= ' colors="' . $config['colors'] . '"';
        }

        if (isset($config['size'])) {
            $code .= ' size="' . $config['size'] . '"';
        }

        if (isset($config['recommend'])) {
            $code .= '  recommend ';
        }

        if (isset($config['alpha'])) {
            $code .= '  alpha ';
        }

        if (isset($config['hue'])) {
            $code .= '  v-bind:hue="false" ';
        }

        if (isset($config['colors'])) {
            $code .= ' v-bind:colors="' . $config['colors'] . '"';
        }

        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }


        $code .= '>' . PHP_EOL;
        $code .= '</Color-Picker>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var ColorPicker = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']}:'#df2525',
                              {$this->config['colors']}:['#19be6b', '#512DA8' ]
                        }
                    },
                    methods:{

                       func:function(){

                            },

                       func2:function(){


                        },

                    }
                });
        new ColorPicker().\$mount('#ColorPicker');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
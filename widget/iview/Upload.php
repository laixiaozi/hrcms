<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 上传的小部件
 */
class Upload extends Widget
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
        $code = '<Upload ';
        if (isset($config['action'])) {
            $code .= ' action="' . $config['action'] . '"';
        }

        if (isset($config['multiple'])) {
            $code .= '  multiple  ';
        }

        if (isset($config['type']) && $config['type'] == 'drag') {
            $code .= ' type="drag" ';
        }

        if (isset($config['before-upload'])) {
            $code .= '  v-bind:before-upload="' . $config['before-upload'] . '" ';
        }
        $code .= '>' . PHP_EOL;
        if (isset($config['type']) && $config['type'] == 'drag') {
            $code .= '<Icon type="ios-cloud-upload" size="52" style="color: #3399ff"></Icon><p>Click or drag files here to upload</p>';
        } else {
            $code .= '<i-button type="ghost" icon="ios-cloud-upload-outline">上传文件</i-button>' . PHP_EOL;
        }
        $code .= '</Upload>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Upload = Vue.extend({
                    data: function(){
                        return {
                               
                        }
                    },
                    methods:{

                       beforeUpload:function(){
                             return false;
                            },

                       func2:function(){


                        },

                    }
                });
        new Upload().\$mount('#Upload');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 穿梭框小部件
 */
class Transfer extends Widget
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
        $code = '<Transfer ';

        if (isset($config['dataName'])) {
            $code .= '  v-bind:data="' . $config['dataName'] . '" ';
        }

        if (isset($config['targetkeysName'])) {
            $code .= '  v-bind:target-keys="' . $config['targetkeysName'] . '" ';
        }

        if (isset($config['renderFormat'])) {
            $code .= '  v-bind:render-format="' . $config['renderFormat'] . '" ';
        }




        if (isset($config['event'])) {
            $code .= '  v-on:' . $config['event'] . '="' . $config['eventName'] . '"';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</Transfer>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $data = json_encode($this->config['data']);
        $targetKeys = json_encode($this->config['targetKeys']);
        $js = <<<EOD
                var Transfer = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['dataName']}:{$data},
                              {$this->config['targetkeysName']}:{$targetKeys},
                        }
                    },
                    methods:{
                       {$this->config['renderFormat']}:function(item){
                              return    item.label;
                            },
                    }
                });
        new Transfer().\$mount('#Transfer');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
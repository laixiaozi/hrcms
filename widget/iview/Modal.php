<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 对话框小部件
 */
class Modal extends Widget
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
        }
        $code = $this->createCode($this->config);
        return $code;
    }


    public function createCode()
    {
        $code = '<Modal ';
        if (isset($this->config['title'])) {
            $code .= '  title="' . $this->config['title'] . '" ';
        }

        if (isset($this->config['model'])) {
            $code .= '  v-model="' . $this->config['model'] . '" ';
        }

        if (isset($this->config['event'])) {
            $code .= '  v-on:' . $this->config['event'] . '="' . $this->config['eventName'] . '"';
        }

        $code .= '>' . PHP_EOL;
        $code .= $this->message;
        $code .= '</Modal>' . PHP_EOL;
        if ($this->config['debug']) {
            $code .= '<i-button v-on:click="showModal()" type="primary">显示modal对话框</i-button>';
            unset($this->config['debug']);
        }
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Modal = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']} : false,
                        }
                    },
                    methods:{
                       showModal:function(){
                              console.log(this.{$this->config['model']});
                               this.{$this->config['model']} =  true;
                               //this.\$Modal.confirm({
                               //   title:'标题',
                               //   content:'内容',
                               //});
                               //this.\$Modal.success({
                               //   title:'标题',
                               //   content:'内容',
                               //});
                               //this.\$Modal.info({
                               //   title:'标题',
                               //   content:'内容',
                               //});
                               //this.\$Modal.error({
                               //   title:'标题',
                               //   content:'内容',
                               //});
                               //this.\$Modal.warning({
                               //   title:'标题',
                               //   content:'内容',
                               //});
                               //this.\$Modal.remove()
                            },

                       func2:function(){

                        },

                    }
                });
        new Modal().\$mount('#Modal');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
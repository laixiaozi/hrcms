<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 自动完成小部件
 */
class AutoComplete extends Widget
{

    public $message;

    public $config;

    public $eventList = array('','');

    public $view;

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
        if(isset($this->config['debug'])){
            $this->clientJs();
            unset($this->config['debug']);
        }
        $code = $this->createCode($this->config);
        return $code;
    }


    public function createCode($config)
    {
        $code = '<auto-complete ';
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        if (isset($config['placeholder'])) {
            $code .= ' placeholder="' . $config['placeholder'] . '"';
        }

        if (isset($config['data'])) {
            $code .= ' v-bind:data="' . $config['data'] . '"';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</auto-complete>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $data = json_encode($this->config['data']);
        $js = <<<EOD
          var AutocomleteWidget = Vue.extend({
                 data: function(){
                    return {
                      {$this->config['model']}: '',
                      {$this->config['data']}:[],
                    }
                 },
                  methods:{
                   func:function(e){
                     console.log(e);
                   }
                 }
          });
          new AutocomleteWidget().\$mount('#autocomplete');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
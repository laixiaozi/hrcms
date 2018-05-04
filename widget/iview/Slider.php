<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 滑块小部件
 */
class Slider extends Widget
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
        $code = '<Slider ';
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        if (isset($config['tip-format'])) {
            $code .= ' v-bind:tip-format="' . $config['tip-format'] . '"';
        }

        if (isset($config['range'])) {
             $code .=   '  ' .$config['range'] . ' ';  //开启双滑块
        }

        if (isset($config['disabled'])) {
            $code .=   '  ' .$config['disabled'] . ' ';  //开启双滑块
        }

        if (isset($config['show-input'])) {
            $code .=   '  ' .$config['show-input'] . ' ';  //开启双滑块
        }

        $code .= '>' . PHP_EOL;
        $code .= '</Slider>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $data = json_encode($this->config['data']);
        $js = <<<EOD
          var Imenu = Vue.extend({
                 data: function(){
                    return {
                      {$this->config['model']}:[],
                      cascadeData:{$data}
                    }
                 },
                  methods:{
                   func:function(e){
                     console.log(e);
                   }
                 }
          });
          new Imenu().\$mount('#slider');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
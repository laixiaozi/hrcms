<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 测试一个小部件
 *
 * $demoIswitch = array(
 * 'slot' => 'open', // close
 * 'size' => 'large',
 * 'icon' => 'android-close',
 * );
 */
class Iswitch extends Widget
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
        $code = '<i-switch ';
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }
        if (isset($config['size'])) {
            $code .= '  size= "' . $config['size'] . '" ';
        }

        if (isset($config['slot'])) {
            $code .= '  slot= "' . $config['slot'] . '" ';
        }
        $code .= '>' . PHP_EOL;

        if (isset($config['slot']) && isset($config['icon'])) {
            $code .= ' <icon  slot= "' . $config['slot'] . '" type= "' . $config['icon'] . '"  ></icon>';
        }
        $code .= '</i-switch>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
          var IswitchWidget = Vue.extend({
                 data: function(){
                    return {
                      {$this->config['model']}:'',
                    }
                 },
                  methods:{
                   func:function(e){
                     console.log(e);
                   }
                 }
          });
          new IswitchWidget().\$mount('#iswitch');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
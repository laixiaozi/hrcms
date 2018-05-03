<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use app\assets\IviewAsset;
use Yii;

/**
 * Table小部件,仅做展示使用。事件需要重新写
 */
class Table extends Widget
{

    public $message;

    public $config;

    public $data;

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

        if (is_null($this->data)) {
            $this->data = array();
        }
        if (is_null($this->view)) {
            $this->view = Yii::$app->getView();
        }
    }


    public function run()
    {
        $this->clientScript();
        $code = $this->createCode($this->config);
        return $code;
    }


    public function createCode($config)
    {
        $code = '<i-Table v-bind:columns="column"  v-bind:data="data"';
        if (isset($config['icon'])) {
            $code .= ' icon="' . $config['icon'] . '"';
        }
        $code .= '>' . PHP_EOL;
        $code .= '</i-Table>' . PHP_EOL;
        return $code;
    }

    public function clientScript()
    {
        $column = json_encode($this->data['column']);
        $data    = json_encode($this->data['data']);
        $js = <<<EOD
          var Itable = Vue.extend({
               data:function(){
                return {
                    column : $column,
                     data : $data
                   }
               }
          });
          new Itable().\$mount('#test');
EOD;
        $this->view->registerJs($js, \yii\web\view::POS_END);
    }


}
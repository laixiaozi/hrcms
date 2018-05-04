<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 测试一个小部件
 */
class Select extends Widget
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
        $code = '<i-Select ';
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        if (isset($config['size'])) {
            $code .= ' size="' . $config['size'] . '"';
        }

        if (isset($config['clearable'])) {
            $code .= '  ' . $config['clearable'] . ' ';
        }

        if (isset($config['disabled'])) {
            $code .= '  ' . $config['disabled'] . ' ';
        }

        if (isset($config['multiple'])) {
            $code .= '  ' . $config['multiple'] . ' ';
        }

        if (isset($config['filterable'])) {
            $code .= '  ' . $config['filterable'] . ' ';
        }

        $code .= '>' . PHP_EOL;

        $code .= '<i-option v-for="item in selectData" v-bind:key="item.value" v-bind:value="item.value" >{{item.label}}</i-option>';

        $code .= '</i-Select>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $model = '';
        $selectData = json_encode($this->config['data']);
        if(!empty($this->config['model'])){$model = $this->config['model'].':""';}
        $js = <<<EOD
           var iSelect = Vue.extend({
                  data:function(){
                   return {
                     selectData:{$selectData},
                     {$model}
                   }
               },
                methods:{
                   func:function(e){
                     console.log(e);
                   }
                 }
           });
           new iSelect().\$mount('#select');
EOD;

        $this->view->registerJs($js, \yii\web\View::POS_END);

    }


}
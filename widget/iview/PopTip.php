<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * pop小部件
 */
class PopTip extends Widget
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

        if(is_null($this->view)){
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


    public function createCode()
    {
        $code = '<PopTip ';
        if (isset($this->config['placement'])) {
            $code .= ' placement="' . $this->config['placement'] . '"';
        }
        if (isset($this->config['confirm'])) {
             $code .=   '  confirm  ';
        }
        if (isset($this->config['confirm']['title'])) {
            $code .=   '  title="'. trim($this->config['confirm']['title']).'" ';
        }
        if (isset($this->config['confirm']['okText'])) {
            $code .=   '  ok-text="'. trim($this->config['confirm']['okText']).'" ';
        }
        if (isset($this->config['confirm']['cancelText'])) {
            $code .=   '  cancel-text="'. trim($this->config['confirm']['cancelText']).'" ';
        }
        if (isset($this->config['confirm']['onOk'])) {
            $code .=   '  v-on:on-ok="'. trim($this->config['confirm']['onOk']).'" ';
        }
        if (isset($this->config['confirm']['onCancel'])) {
            $code .=   '  v-on:on-cancel="'. trim($this->config['confirm']['onCancel']).'" ';
        }
        if (isset($this->config['model'])) {
            $code .= ' v-model="' . $this->config['model'] . '"';
        }
        $code .= '>' . PHP_EOL;
        $code .= $this->message;
        $code .= '</PopTip>' . PHP_EOL;
        return $code;
    }

    public function clientJs(){
        $js = <<<EOD
                var PopTip = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']}:true,
                        }
                    },
                    methods:{
                       {$this->config['confirm']['onOk']}:function(){
                              this.\$Message.info('点击了确定');
                            },

                       {$this->config['confirm']['onCancel']}:function(){
                               this.\$Message.info('点击了取消');
                        },
                    }
                });
        new PopTip().\$mount('#PopTip');
EOD;
    $this->view->registerJs($js , \yii\web\View::POS_END);
    }


}
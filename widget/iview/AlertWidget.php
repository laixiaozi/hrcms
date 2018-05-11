<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 测试一个小部件
 */
class AlertWidget extends Widget
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
        $code = '<Alert';
        if (isset($config['type'])) {
            $code .= ' type="' . $config['type'] . '"';
        }

        if (isset($config['banner'])) {
            $code .= ' banner ';
        }

        if (isset($config['closable'])) {
            $code .= ' closable ';
        }

        if (isset($config['showIcon'])) {
            $code .= ' show-icon ';
        }
        $code .= '>' . PHP_EOL;


        if (isset($config['desc'])) {
            $code .= ' <p slot="desc"> ' . PHP_EOL;
            $code .= $config['desc'];
            $code .= ' </p> ' . PHP_EOL;
        }
        $code .= $this->message;
        $code .= '</Alert>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var AlertWidget = Vue.extend({
                    data: function(){
                        return {
                             }
                    },
                });
        new AlertWidget().\$mount('#AlertWidget');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
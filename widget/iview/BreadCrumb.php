<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 面包屑小部件
 */
class BreadCrumb extends Widget
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


    public function createCode()
    {
        $code = '<BreadCrumb>' . PHP_EOL;
        if (isset($this->config['items'])) {
            foreach ($this->config['items'] as $item) {
                $code .= '<BreadCrumb-item';
                if (isset($item['to'])) {
                    $code .= ' to="' . $item['to'] . '"';
                } else if (isset($item['replace'])) {
                    $code .= ' replace="' . $item['replae'] . '"';
                }
                $code .= '>' . PHP_EOL;
                $code .= $item['label'];
                $code .= '</BreadCrumb-item>' . PHP_EOL;
            }
        }

        $code .= '</BreadCrumb>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var BreadCrumb = Vue.extend({
                    data: function(){
                        return {
                        }
                    },
                    methods:{
                       func:function(){
                            },

                       func2:function(){
                        },
                    }
                });
        new BreadCrumb().\$mount('#BreadCrumb');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
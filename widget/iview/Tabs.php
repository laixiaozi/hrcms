<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 标签页小部件
 */
class Tabs extends Widget
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
        $code = '<Tabs ';
        if (isset($this->config['type'])) {
            $code .= ' type="' . $this->config['type'] . '"';
        }
        if (isset($this->config['size'])) {
            $code .= ' size="' . $this->config['size'] . '"';
        }

        $code .= '>' . PHP_EOL;
        if (isset($this->config['TabPane']) && is_array($this->config['TabPane'])) {
            foreach ($this->config['TabPane'] as $tabpane) {
                $code .= '<Tab-Pane label="' . $tabpane['label'] . '"';
                if (isset($this->config['disabled'])) {
                    $code .= ' disabled ';
                }
                $code .= '>' . $tabpane['content'] . '</Tab-Pane>' . PHP_EOL;

            }
        }
        $code .= '</Tabs>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Tabs = Vue.extend({
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
        new Tabs().\$mount('#Tabs');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
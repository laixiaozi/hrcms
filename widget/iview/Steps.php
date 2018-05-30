<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 步骤小部件
 */
class Steps extends Widget
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
        $code = '<Steps ';

        if (isset($this->config['size'])) {
            $code .= ' size="' . $this->config['size'] . '"';
        }

        if (isset($this->config['status'])) {
            $code .= ' status="' . $this->config['status'] . '"';
        }

        if (isset($this->config['current'])) {
            $code .= '  v-bind:current="' . $this->config['current'] . '" ';
        }

        $code .= '>' . PHP_EOL;
        if (isset($this->config['items']) && !empty($this->config['items'])) {
            foreach ($this->config['items'] as $item) {
                $code .= '<step';
                if (isset($item['icon'])) {
                    $code .= ' icon="' . $item['icon'] . '"';
                }
                if (isset($item['title'])) {
                    $code .= ' title="' . $item['title'] . '"';
                }
                if (isset($item['content'])) {
                    $code .= ' content="' . $item['content'] . '"';
                }
                $code .= '></step>' .PHP_EOL;
            }
        }
        $code .= '</Steps>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Steps = Vue.extend({
                    data: function(){
                        return {
                             current:{$this->config['current']}
                        }
                    },
                    methods:{

                       func:function(){
                            },

                       func2:function(){
                        },
                    }
                });
        new Steps().\$mount('#Steps');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
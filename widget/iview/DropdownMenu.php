<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 测试一个小部件
 */
class DropdownMenu extends Widget
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
        $code = '<Dropdown ';
        if (isset($this->config['data'])) {
            $code .= '  v-bind:data="' . $this->config['clearable'] . '" ';
        }
        if (isset($this->config['model'])) {
            $code .= ' v-model="' . $this->config['model'] . '"';
        }
        if (isset($this->config['event'])) {
            $code .= '  v-on:' . $this->config['event'] . '="' . $this->config['eventName'] . '"';
        }
        $code .= '>' . PHP_EOL;
        $code .= '<a href="javascript:void(0);">' . $this->message . '<icon type="arrow-down-b"></icon></a>' . PHP_EOL;
        if (isset($this->config['dropdownmenu']) && is_array($this->config['dropdownmenu'])) {
            $code .= '<DropDown-menu slot="list">' . PHP_EOL;
            foreach ($this->config['dropdownmenu'] as $menu) {
                if (is_string($menu)) {
                    $code .= '<Dropdown-item>' . $menu . '</Dropdown-item>';
                } else if (is_array($menu)) {
                    $code .= '<Dropdown-item ';
                    if (isset($menu[1])) {
                        $code .= $menu[1];
                    }
                    if (isset($menu[2])) {
                        $code .= $menu[2];
                    }
                    $code .= '>';
                    $code .= $menu[0];
                    $code .= '</Dropdown-item>';
                }

            }
            $code .= '</DropDown-menu>' . PHP_EOL;
        }
        $code .= '</Dropdown>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var DropdownMenu = Vue.extend({
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
        new DropdownMenu().\$mount('#DropdownMenu');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
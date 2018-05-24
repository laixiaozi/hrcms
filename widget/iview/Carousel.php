<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 * 走马灯小部件
 */
class Carousel extends Widget
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
        $code = '<Carousel ';

        if (isset($this->config['autoplay'])) {
            $code .= '  v-bind:autoplay="' . $this->config['autoplay'] . '" ';
        }

        if (isset($this->config['loop'])) {
            $code .= '  v-bind:loop="' . $this->config['loop'] . '" ';
        }
        if (isset($this->config['arrow'])) {
            $code .= '  v-bind:loop="' . $this->config['arrow'] . '" ';
        }

        if (isset($this->config['trigger'])) {
            $code .= '  v-bind:trigger="' . $this->config['trigger'] . '" ';
        }

        if (isset($this->config['model'])) {
            $code .= ' v-model="' . $this->config['model'] . '"';
        }
        $code .= '>' . PHP_EOL;
        if (isset($this->config['carouselItem']) && is_array($this->config['carouselItem'])) {
            $code .= '<carousel-item>' . join('</carousel-item><carousel-item>', $this->config['carouselItem']) . '</carousel-item>' . PHP_EOL;
        }

        $code .= '</Carousel>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
                var Carousel = Vue.extend({
                    data: function(){
                        return {
                              {$this->config['model']}:0,
                              {$this->config['loop']}: true,
                              {$this->config['arrow']}:  'hover',
                              {$this->config['autoplay']}: true,
                              {$this->config['dots']}:'inside',
                              {$this->config['trigger']}:'hover',
                        }
                    },
                    methods:{
                    
                       func:function(){
                            },

                       func2:function(){
                        },
                        
                    }
                });
        new Carousel().\$mount('#Carousel');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
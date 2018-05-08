<?php

namespace app\widget\iview;

use  yii\helpers\html;
use yii\base\Widget;
use Yii;

/**
 * iview 生成button
 */
class Button extends Widget
{
    public $btntxt;

    public $btntype;

    private $btntypeList = array('primary', 'ghost', 'dashed', 'text', 'info', 'success', 'warning', 'error');

    public $view;

    public $eventList = array('','');

    public function init()
    {
        parent::init();
        if (is_null($this->btntxt)) {
            $this->btntxt = '按钮';
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
        $btntype = '';
        if (!is_null($this->btntype) && in_array($this->btntype, $this->btntypeList)) {
            $btntype = 'type=' . $this->btntype;
        }
        return '<i-button ' . $btntype . '>' . $this->btntxt . '</i-button>';
    }

    public function clientJs()
    {
        $data = json_encode($this->config['data']);
        $js = <<<EOD
          var ButtonWidget = Vue.extend({
                 data: function(){
                    return {
                      {$this->config['model']}:[],
                      cascadeData:{$data}
                    }
                 },
                  methods:{
                   func:function(e){
                     console.log(e);
                   }
                 }
          });
          new ButtonWidget().\$mount('#button');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }
}
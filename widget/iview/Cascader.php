<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;


/**
 * 级联菜单小部件
 * 级联选择对数据有较严格要求，请参照示例的格式使用data，每项数据至少包含 value、label 两项，子集为 children，以此类推。
 * value 为当前选择的数据的 value 值的数组，比如 ['beijing', 'gugong'] ，按照级联顺序依次排序，使用 v-model 进行双向绑定。
 */
class Cascader extends Widget
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
        $code = '<Cascader ';
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '"';
        }

        // large small
        if (isset($config['size'])) {
            $code .= ' size="' . $config['size'] . '"';
        }

        if (isset($config['trigger'])) {
            $code .= ' trigger="hover"';
        }

        if (isset($config['dataName'])) {
            $code .= ' v-bind:data="' . $config['dataName'] . '" ';
        }

        if (isset($config['disabled'])) {
            $code .= '  ' . $config['disabled'] . ' ';
        }

        if (isset($config['change-on-select'])) {
            $code .= '  ' . $config['change-on-select'] . ' ';
        }

        /**
         * 使用 load-data 属性可以异步加载子选项，需要给数据增加 loading 来标识当前是否在加载中。
         *
         * load-data 的第二个参数为回调，如果执行，则会自动展开当前项的子列表。
         */
        if (isset($config['load-data'])) {
            $code .= '  v-bind:load-data="' . $config['load-data'] . '" ';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</Cascader>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $data = json_encode($this->config['data']);
        $js = <<<EOD
          var CascaderWidget = Vue.extend({
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
          new CascaderWidget().\$mount('#cascader');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;
use Yii;

/**
 *  API #
 * Input props #
 * 属性    说明    类型    默认值
 * type    输入框类型，可选值为 text、password、textarea、url、email、date    String    text
 * value    绑定的值，可使用 v-model 双向绑定    String | Number    空
 * size    输入框尺寸，可选值为large、small、default或者不设置    String    -
 * placeholder    占位文本    String    -
 * clearable    是否显示清空按钮    Boolean    false
 * disabled    设置输入框为禁用状态    Boolean    false
 * readonly    设置输入框为只读    Boolean    false
 * maxlength    最大输入长度    Number    -
 * icon    输入框尾部图标，仅在 text 类型下有效    String    -
 * rows    文本域默认行数，仅在 textarea 类型下有效    Number    2
 * autosize    自适应内容高度，仅在 textarea 类型下有效，可传入对象，如 { minRows: 2, maxRows: 6 }    Boolean | Object    false
 * number    将用户的输入转换为 Number 类型    Boolean    false
 * autofocus    自动获取焦点    Boolean    false
 * autocomplete    原生的自动完成功能，可选值为 off 和 on    String    off
 * element-id    给表单元素设置 id，详见 Form 用法。    String    -
 * spellcheck    原生的 spellcheck 属性    Boolean    false
 * wrap    原生的 wrap 属性，可选值为 hard 和 soft，仅在 textarea 下生效    String    soft
 * Input events #
 * 事件名    说明    返回值
 * on-enter    按下回车键时触发    无
 * on-click    设置 icon 属性后，点击图标时触发    无
 * on-change    数据改变时触发    event
 * on-focus    输入框聚焦时触发    无
 * on-blur    输入框失去焦点时触发    无
 * on-keyup    原生的 keyup 事件    event
 * on-keydown    原生的 keydown 事件    event
 * on-keypress    原生的 keypress 事件    event
 * Input slot #
 * 名称    说明
 * prepend    前置内容，仅在 text 类型下有效
 * append    后置内容，仅在 text 类型下有效
 * Input methods #
 * 方法名    说明    参数
 * focus    手动聚焦输入框    无
 *<p style="width:30%;"><?= Input::widget(['message' => 'input测试', 'config' => $demoInput]); ?></p>
 * #######DEMO########
 * $demoInput = array(
 * 'model' => 'demoinput',
 * 'icon' => 'search',
 * 'size' => 'large',
 * 'clearable' => 'clearable',
 * //    'type'=>'textarea',
 * //    'rows' => '9',
 * 'slot' => '<span slot="append" >Http://</span>',
 * 'slot' => '<span slot="prepend" >Search</span>',
 * 'disabled' => 'disabled',
 * );
 */

/**
 * 测试一个小部件
 */
class Input extends Widget
{

    public $message;

    public $config;

    public $view;

    public $eventList = array(
        'on-enter' => array(
            'desc' => '按下回车键时触发',
            'type' => '无',
            'default' => '',
        ),
        'on-click' => array(
            'desc' => '设置 icon 属性后，点击图标时触发',
            'type' => '无',
            'default' => '',
        ),
        'on-change' => array(
            'desc' => '数据改变时触发',
            'type' => 'event',
            'default' => '',
        ),
        'on-focus' => array(
            'desc' => '输入框聚焦时触发',
            'type' => '无',
            'default' => '',
        ),
        'on-blur' => array(
            'desc' => '输入框失去焦点时触发',
            'type' => '无',
            'default' => '',
        ),
        'on-keyup' => array(
            'desc' => '原生的 keyup 事件',
            'type' => 'event',
            'default' => '',
        ),
        'on-keydown' => array(
            'desc' => '原生的 keydown 事件',
            'type' => 'event',
            'default' => '',
        ),
        'on-keypress' => array(
            'desc' => '原生的 keypress 事件',
            'type' => 'event',
            'default' => '',
        ),
    );

    public $attributeList = array(

        'type' => array(
            'value' => array('text', 'password', 'textarea', 'url', 'date'),
            'desc' => '输入框类型',
            'type' => 'String',
            'default' => 'text',
        ),

        'value' => array(
            'value' => array('text', 'password', 'textarea', 'url', 'date'),
            'desc' => '绑定的值，可使用 v-model 双向绑定',
            'type' => 'String | Number',
            'default' => '',
        ),

        'size' => array(
            'value' => array('large', 'small', 'default'),
            'desc' => '输入框尺寸,或者不设置',
            'type' => 'String',
            'default' => '',
        ),

        'placeholder' => array(
            'value' => '',
            'desc' => '占位文本',
            'type' => 'String',
            'default' => '',
        ),

        'clearable' => array(
            'value' => 'clearable',
            'desc' => '是否显示清空按钮',
            'type' => 'Boolean',
            'default' => false,
        ),

        'disabled' => array(
            'value' => 'disabled',
            'desc' => '设置输入框为禁用状态',
            'type' => 'Boolean',
            'default' => false,
        ),

        'readonly' => array(
            'value' => 'readonly',
            'desc' => '设置输入框为只读',
            'type' => 'Boolean',
            'default' => false,
        ),

        'maxlength' => array(
            'value' => array('text', 'password', 'textarea', 'url', 'date'),
            'desc' => '最大输入长度',
            'type' => 'String | Number',
            'default' => '',
        ),

        'value' => array(
            'value' => array('text', 'password', 'textarea', 'url', 'date'),
            'desc' => '绑定的值，可使用 v-model 双向绑定',
            'type' => 'String | Number',
            'default' => '',
        ),
    );

    public $solt = array(
        'prepend' => array(
            'desc' => '前置内容，仅在 text 类型下有效',
            'type' => '',
            'default' => '',
        ),
        'append' => array(
            'desc' => '后置内容，仅在 text 类型下有效',
            'type' => '',
            'default' => '',
        ),
    );

    public $methods = array(
        'focus' => array(
            'desc' => '手动聚焦输入框',
            'type' => '无',
            'default' => '',
        ),
    );

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

    /**
     *  生成代码iview代码
     *  $config = array(
     *      'size' => ['small , larege]
     *      'clearable' //显示清空按钮
     *      'icon, //通过 icon 属性可以在输入框右边加一个图标。点击图标，会触发 on-click 事件
     *      'type' => 'textarea', 通过设置属性 type 为 textarea 来使用文本域，用于多行输入
     *      'rows' => 20   //通过设置属性 rows 控制文本域默认显示的行数。
     *      'autosize' , 设置属性 autosize，文本域会自动适应高度的变化。 autosize也可以设定为一个对象，指定最小行数和最大行数。 autosize="{minRows: 2,maxRows: 5}"
     *      'disabled',
     *      '' //通过前置和后置的 slot 可以实现复合型的输入框。<Input v-model="value11"> <span slot="prepend">http://</span><span slot="append">.com</span> </Input>
     *
     *   )
     */
    public function createCode($config)
    {
        $code = '<i-input placeholder="' . $this->message . '"';

        //绑定的模型
        if (isset($config['model'])) {
            $code .= ' v-model="' . $config['model'] . '" ';
        }
        if (isset($config['icon'])) {
            $code .= ' icon="' . $config['icon'] . '" ';
        }
        if (isset($config['size'])) {
            $code .= ' size="' . $config['size'] . '" ';
        }
        if (isset($config['clearable'])) {
            $code .= '  ' . $config['clearable'] . ' ';
        }

        if (isset($config['disabled'])) {
            $code .= '  ' . $config['disabled'] . ' ';
        }

        if (isset($config['type']) && strtolower(trim($config['type'])) == 'textarea') {
            $code .= ' type="textarea" ';
            if (isset($config['autosize'])) {
                if (is_array($config['autosize'])) {
                    $code .= ' autosize="' . json_encode($config['autosize']) . '" ';
                } else {
                    $code .= ' autosize="' . boolvale($config['autosize']) . '" ';
                }
            }

            if (isset($config['rows']) && is_numeric($config['rows'])) {
                $code .= ' v-bind:rows="' . $config['rows'] . '" ';
            }
        }
        $code .= '>' . PHP_EOL;
        if (isset($config['slot']) && !is_array($config['slot'])) {
            $code .= $config['slot'];
        } else {
            for ($i = 0; $i < count($config['slot']); $i++) {
                $code .= $config['slot'][$i];
            }
        }
        $code .= '</i-input>' . PHP_EOL;
        return $code;
    }

    public function clientJs()
    {
        $js = <<<EOD
          var Imenu = Vue.extend({
                 data: function(){
                    return {
                      {$this->config['model']}:'',
                    }
                 },
                  methods:{
                   func:function(e){
                     console.log(e);
                   }
                 }
          });
          new Imenu().\$mount('#input');
EOD;
        $this->view->registerJs($js, \yii\web\View::POS_END);
    }


}
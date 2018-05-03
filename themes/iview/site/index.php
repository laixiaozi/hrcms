<?php

use app\widget\iview\test;
use app\widget\iview\test2;
use app\widget\iview\Button;
use app\widget\iview\Menu;
use app\widget\iview\Icon;
use app\widget\iview\Input;
use app\widget\iview\Radio;
use app\widget\iview\Checkbox;
use app\widget\iview\iswitch;
use app\widget\iview\Table;
use app\Widget\iview\Select;
use app\widget\iview\AutoComplete;
use app\widget\iview\Slider;
use app\widget\iview\Datepicker;
use app\widget\iview\TimePicker;

$demoMenu = array(
    ['name' => 'required', 'text' => '测试', 'icon' => 'leaf'],
    ['name' => 'required2', 'text' => '测试22', 'icon' => 'heart'],
    ['name' => 'required3', 'text' => '测试22', 'icon' => 'heart', 'title' => '子菜单标题', 'items' => [
        ['name' => 'required2-1', 'text' => '测试22', 'icon' => 'heart'],
        ['name' => 'required2-2', 'text' => '测试22', 'icon' => 'heart'],
        ['name' => 'required2-3', 'text' => '测试22', 'icon' => 'heart'],
    ],
    ],
);

$demoInput = array(
    'model' => 'demoInput',
//    'icon' => 'search',
    'size' => 'large',
//    'clearable' => 'clearable',
//    'type'=>'textarea',
//    'rows' => '9',
    'slot' => ['<span slot="prepend" >Http://</span>', '<span slot="append" >Search</span>'],
//    'slot' => '<span slot="prepend" >Search</span>',
//    'disabled' => 'disabled',
);

$demoRadio = array(
    'mode' => 'demoRadio',
);

$demoRadio2 = array(
    'items' => array(
        'parameters' => array('model' => 'radioGroupmodel', 'vertical' => 'vertical'),
        'list' => array(
            array('label' => 'radio2', 'icon' => 'social-android', 'text' => '显示的文字'),
            array('label' => 'radio3', 'icon' => 'social-android', 'text' => '显示的文字22'),
        ),
    ),
);

$demoCheckbox = array(
    'mode' => 'demoCheckbox',
    'label' => 'checkbox',
);

$demoCheckboxGroup = array(
    'items' => array(
        'parameters' => array('model' => 'checkboxGroupModel'),
        'list' => array(
            array('label' => 'checkBox分组测试', 'icon' => 'social-android', 'text' => '显示的文字'),
            array('label' => 'checkBox分组测试2', 'icon' => 'social-android', 'text' => '显示的文字22'),
        ),
    ),
);

$demoIswitch = array(
    'slot' => 'open', // close
    'size' => 'large',
    'icon' => 'android-close',
);


$demoTable = array(
    'column' => array(
        array('title' => '名称', 'key' => 'name'),
        array('title' => '年龄', 'key' => 'age'),
    ),
    'data' => array(
        array('name' => 'ryan', 'age' => 13),
        array('name' => '刘备', 'age' => 23),
        array('name' => '赵云', 'age' => 23),
    ),
);

$selectData = array(
    array('label' => 'new yourk', 'value' => '1'),
    array('label' => 'new yourk2', 'value' => '2'),
    array('label' => 'new yourk3', 'value' => '3'),
    array('label' => 'new yourk4', 'value' => '4'),
    array('label' => 'new yourk5', 'value' => '5'),
    array('label' => 'new yourk6', 'value' => '6'),
);

$demoSelect = array(
    'model' => 'demoSelect',
    'data' => $selectData,
);


$demoSlider = array(
    'range' => 'range',
);


$demoDatePicker = array(
    'type' => 'daterange',
    'format' => 'yyyy/MM/dd'
);

$demoTimePicker = array(
        'type' => 'timerange'
);

$this->title = '测试';
?>

<div style="height:300px;">
    <div id="menu">
        <?= menu::widget(['menuData' => $demoMenu, 'event' => 'on-select', 'eventName' => 'func']) ?>
        <p style="width:30%;"><?= Input::widget(['message' => 'input测试', 'config' => $demoInput]); ?></p>
        <p style="width:30%;"><?= Radio::widget(['message' => 'input测试', 'config' => $demoRadio]); ?></p>
        <p style="width:30%;"><?= Radio::widget(['message' => 'radio测试2', 'config' => $demoRadio2]); ?></p>

        <p style="width:30%;"><?= Checkbox::widget(['message' => '单个checkbox测试', 'config' => $demoCheckbox]); ?></p>

        <p style="width:30%;"><?= Checkbox::widget(['message' => 'checkbox列表测试', 'config' => $demoCheckboxGroup]); ?></p>

        <p style="width:30%;"><?= iswitch::widget(['message' => 'checkbox列表测试', 'config' => $demoIswitch]); ?></p>
        <br/><br/>
        <div>
            <?= Icon::widget(['icon' => rand(0, 700)]); ?>
        </div>
        <br/>

        <p style="width:30%;"><?= AutoComplete::widget(); ?></p><br/>

        <p style="width:30%;"><?= Slider::widget(['message' => 'hello slider', 'config' => $demoSlider]); ?></p><br/>

        <p style="width:30%;"><?= Datepicker::widget(['message' => 'hello datePicker', 'config' => $demoDatePicker]); ?></p>
        <br/>


        <p style="width:30%;"><?= TimePicker::widget(['message' => 'hello datePicker', 'config' => $demoTimePicker]); ?></p>
        <br/>

    </div>

    <!-- 不需要使用new vue()这种格式 -->
    <p style="width:30%;" id="test"><?= Table::widget(['message' => 'table测试', 'data' => $demoTable]); ?></p>

    <div id="select">
        <p style="width:30%;"><?= Select::widget(['message' => 'select列表', 'config' => $demoSelect]); ?></p>
    </div>

</div>


<?php $this->beginBlock('vue'); ?>
    new Vue({
        el:'#menu',
            data:{
                demoCheckbox:'',
                checkboxGroupModel:[],
                radioGroupmodel:'',
                demoRadio:'',
                demoInput:'',
                demoSelect:'',
                demoSelectGroup:[]
            },
            methods:{
                func:function(e){
                  console.log(e);
                },

        }
    });
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['vue'], \yii\web\View::POS_END); ?>

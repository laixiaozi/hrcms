<?php

use app\widget\iview\test;
use app\widget\iview\test2;
use app\widget\iview\Button;
use app\widget\iview\Menu;
use app\widget\iview\Icon;
use app\widget\iview\Input;
use app\widget\iview\Radio;
use app\widget\iview\RadioGroup;
use app\widget\iview\Checkbox;
use app\widget\iview\CheckBoxGroup;
use app\widget\iview\iswitch;
use app\widget\iview\Table;
use app\Widget\iview\Select;
use app\widget\iview\AutoComplete;
use app\widget\iview\Slider;
use app\widget\iview\Datepicker;
use app\widget\iview\TimePicker;
use app\widget\iview\Cascader;
use app\widget\iview\Transfer;
use app\widget\iview\InputNumber;
use app\widget\iview\Rate;
use app\widget\iview\Upload;
use app\widget\iview\ColorPicker;
use app\widget\iview\Form;

$demoMenu = array(
    'debug' => true,
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
    'debug' => true,
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
    'model' => 'demoRadio',
    'debug' => true,
);

$demoRadio2 = array(
    'debug' => true,
    'items' => array(
        'parameters' => array('model' => 'demoRadio', 'vertical' => 'vertical'),
        'list' => array(
            array('label' => 'radio2', 'icon' => 'social-android', 'text' => '显示的文字'),
            array('label' => 'radio3', 'icon' => 'social-android', 'text' => '显示的文字22'),
        ),
    ),
);

$demoCheckbox = array(
    'debug' => true,
    'model' => 'demoCheckbox',
    'label' => 'checkbox',
);

$demoCheckboxGroup = array(
    'debug' => true,
    'items' => array(
        'parameters' => array('model' => 'checkboxGroupModel'),
        'list' => array(
            array('label' => 'checkBox分组测试', 'icon' => 'social-android', 'text' => '显示的文字'),
            array('label' => 'checkBox分组测试2', 'icon' => 'social-android', 'text' => '显示的文字22'),
        ),
    ),
);

$demoIswitch = array(
    'debug' => true,
    'slot' => 'open', // close
    'size' => 'large',
    'icon' => 'android-close',
    'model' => 'iswitch',
);


$demoTable = array(
    'debug' => true,
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


$demoSelect = array(
    'debug' => true,
    'model' => 'demoSelect',
    'data' => array(
        array('label' => 'new yourk', 'value' => '1'),
        array('label' => 'new yourk2', 'value' => '2'),
        array('label' => 'new yourk3', 'value' => '3'),
        array('label' => 'new yourk4', 'value' => '4'),
        array('label' => 'new yourk5', 'value' => '5'),
        array('label' => 'new yourk6', 'value' => '6'),
    ),
);


$demoSlider = array(
    'debug' => true,
    'range' => 'range',
    'model' => 'sliderwidget',
);


$demoDatePicker = array(
    'debug' => true,
    'type' => 'daterange',
    'format' => 'yyyy/MM/dd',
    'model' => 'datepicker',
);

$demoTimePicker = array(
    'debug' => true,
    'type' => 'timerange',
    'model' => 'timepicker',

);

$demoCascadeData = array(
    'debug' => true,
    'model' => 'cascade',
    'dataName' => 'cascadeData',
    'data' => array(
        array('label' => '级联菜单', 'value' => '6', 'children' => array(
            array('label' => '子集菜单一', 'value' => '5'),
            array('label' => '子集菜单二', 'value' => '3'),
            array('label' => '级联菜单1', 'value' => '6', 'children' => array(
                array('label' => '子集菜单一1', 'value' => '5'),
                array('label' => '子集菜单二2', 'value' => '3'),
            )),
            array('label' => '级联菜单2', 'value' => '6', 'children' => array(
                array('label' => '子集菜单一2', 'value' => '5'),
                array('label' => '子集菜单二2', 'value' => '3'),
            )),
        )),
        array('label' => '级联菜单', 'value' => '6', 'children' => array(
            array('label' => '子集菜单一', 'value' => '5'),
            array('label' => '子集菜单二', 'value' => '3'),
        )),
    ),
);


$transferData = array(
    'debug' => true,
    'data' => array(
        array('key' => 1, 'label' => '内容', 'disabled' => false),
        array('key' => 2, 'label' => '内容2', 'disabled' => false),
        array('key' => 3, 'label' => '内容3', 'disabled' => false),
        array('key' => 4, 'label' => '内容4', 'disabled' => false),
    ),
    'dataName' => 'data1',
    'targetKeys' => array(1, 2),
    'targetkeysName' => 'targetKeys',
    'renderFormat' => 'render1',
);


$inputNumberData = array(
    'debug' => true,
    'model' => 'inputnumber',
    'size' => 'small',
    'disabledName' => 'disabled1',
    'max' => '',
    'min' => '',
    'step' => '',
    'placeholder' => '',
    'formatter' => '',
    'parser' => '',
);

$demoRateData = array(
    'debug' => true,
    'model' => 'rate',
    'allow-half' => 'allow-half',
    'show-text' => 'allow-half',
//    'disabled' => true,
    'count' => 5,

);

$demoUploadData = array(
    'debug' => true,
    'model' => 'upload',
//    'multiple' => true,
    'before-upload' => 'beforeUpload',
    'type' => 'drag',
    'action' => '',
    'headers'
);

$demoColorPickerData = array(
    'debug' => true,
    'model' => 'colorPick',
    'alpha' => 'alpha',
    'recommend' => 'recommend',
    'colors' => 'recommendcolors',
    'size' => 'large',

);

$this->title = '测试';
?>
<style>
    div: {
        margin: 10px 20px;
        width: 100px;
    }
</style>
<div id="FormWidget" style="width:30%;">
    <?php
    $formDataDemo = array(
        'model' => 'formModel',
    );
    $form = new Form();
    $form->begin(['config' => $formDataDemo]);
    ?>
    <form-item>
        <i-input v-model="formModel.name"></i-input>
        {{formModel.name}}
    </form-item>
    <form-item>

        <div id="input">
            <p style="width:30%;"><?= Input::widget(['message' => 'input测试', 'config' => $demoInput]); ?></p>
        </div>
    </form-item>
    <form-item>

    </form-item>

    <?php
    $form->end();
    ?>
</div>
<div id="select">
    <p style="width:30%;">
        <?= Select::widget(['message' => 'select列表', 'config' => $demoSelect]); ?>
    </p>
    <br>
</div>
<br><br>

<div id="ColorPicker" style="width:30%;">
    <?= ColorPicker::widget(['message' => 'select列表', 'config' => $demoColorPickerData]); ?>
</div>


<div id="Upload" style="width:30%;">
    <?= Upload::widget(['message' => 'select列表', 'config' => $demoUploadData]); ?>
</div>


<div id="Rate">
    <p style="width:30%;">
        <?= Rate::widget(['message' => 'select列表', 'config' => $demoRateData]); ?>
    </p>
    <br>
</div>


<div id="InputNumber">
    <p style="width:30%;">
        <?= InputNumber::widget(['message' => 'inputNumber', 'config' => $inputNumberData]); ?>
    </p>
    <br>
</div>

<div id="Transfer">
    <p style="width:30%;">
        <?= Transfer::widget(['message' => 'Transfer', 'config' => $transferData]); ?>
    </p>
    <br>
</div>


<div id="menu">
    <?= menu::widget(['menuData' => $demoMenu, 'event' => 'on-select', 'eventName' => 'func']) ?>
</div>


<div id="radio">
    <p style="width:30%;"><?= Radio::widget(['message' => 'input测试', 'config' => $demoRadio]); ?></p>
</div>

<div id="radiogroup">
    <p style="width:30%;"><?= RadioGroup::widget(['message' => 'radio测试2', 'config' => $demoRadio2]); ?></p>
</div>

<div id="checkBox">
    <p style="width:30%;"><?= Checkbox::widget(['message' => '单个checkbox测试', 'config' => $demoCheckbox]); ?></p>
</div>

<div id="checkboxGroup">
    <p style="width:30%;"><?= CheckBoxGroup::widget(['message' => 'checkbox列表测试', 'config' => $demoCheckboxGroup]); ?></p>
</div>

<div id="iswitch">
    <p style="width:30%;"><?= iswitch::widget(['message' => 'checkbox列表测试', 'config' => $demoIswitch]); ?></p>
</div>

<div id="icon">
    <?= Icon::widget(['icon' => 402, 'config' => ['debug' => true]]); ?>
</div>

<div id="autocomplete">
    <p style="width:30%;"><?= AutoComplete::widget(['config' => array('debug' => true, 'model' => 'autocomplete', 'data' => 'data')]); ?></p>
    <br/>
</div>


<div id="slider">
    <p style="width:30%;"><?= Slider::widget(['message' => 'hello slider', 'config' => $demoSlider]); ?></p><br/>
</div>

<div id="datepicker">
    <p style="width:30%;"><?= Datepicker::widget(['message' => 'hello datePicker', 'config' => $demoDatePicker]); ?></p>
</div>

<div id="timepicker">
    <p style="width:30%;"><?= TimePicker::widget(['message' => 'hello datePicker', 'config' => $demoTimePicker]); ?></p>
</div>

<div id="table">
    <?= Table::widget(['message' => 'table测试', 'data' => $demoTable, 'config' => array('debug' => true)]); ?>
</div>

<div id="cascader">
    <p style="width:30%;">
        <?= Cascader::widget(['message' => 'select列表', 'config' => $demoCascadeData]); ?>
    </p>
</div>


<?php $this->beginBlock('vue'); ?>
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['vue'], \yii\web\View::POS_END); ?>

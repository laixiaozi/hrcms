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
use app\widget\iview\Collapse;
use app\widget\iview\Badge;
use app\widget\iview\AlertWidget;
use app\widget\iview\Avatar;
use app\widget\iview\Modal;
use app\widget\iview\Progress;
use app\widget\iview\Notice;
use app\widget\iview\Message;
use app\widget\iview\Card;
use app\widget\iview\TimeLine;
use app\widget\iview\Tag;
use app\widget\iview\ToolTip;
use app\widget\iview\PopTip;
use app\widget\iview\Carousel;
use app\widget\iview\Tree;
use app\widget\iview\Tabs;
use app\widget\iview\DropdownMenu;

$cardDemo = array(
    'debug' => true,
);
$messageDemo = array(
    'debug' => true,
    'type' => 'warning',//success , info , loading ,error
    'content' => '一个弹出的测试框',
);

$NoticeDemo = array(
    'debug' => true,
    'type' => 'info',//success , info , loading ,error
    'content' => '一个弹出的测试框',
    'title' => '标题',

);
$ProgressDemo = array(
    'debug' => true,
    'percent' => 30,
//    'vertical' => true,
);

$ModalDemo = array(
    'debug' => true,
    'type' => 'info',//success , info , loading ,error
    'content' => '一个弹出的测试框',
    'title' => '标题钉钉ss',
    'model' => 'model1',
);

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


$AvatarDemo = array(
    'debug' => true,
    'icon' => 'person',
    'sieze' => 'large',
//    'shape' => 'square',
//    'vertical' => true,
);

$BadgeDemo = array(
    'debug' => true,
    'icon' => 'person',
    'sieze' => 'large',
    'count' => 1000,
    'overflowCoun' => 999,
//    'shape' => 'square',
//    'vertical' => true,
);

$alertDemo = array(
    'debug' => true,
    'type' => 'success',
    'showIcon' => true,
    'closeable' => true,
);

$demoColorPickerData = array(
    'debug' => true,
    'model' => 'colorPick',
    'alpha' => 'alpha',
    'recommend' => 'recommend',
    'colors' => 'recommendcolors',
    'size' => 'large',

);
$CollapseDemo = array(
    'debug' => true,
    'model' => 'collapsemodel',
    'accordion' => true,
);

$formDataDemo = array(
    'model' => 'formModel',
);

$timelineData = array(
    'debug' => true,
    'timeLineItem' => array(
        'aaa', '<p>aa</p><p>bb</p>'
    )
);

$tagData = array(
    'debug' => true,
    'checkable' => true,
    'closable' => true,
    'color' => 'blue',
);

$toolTipData = array(
    'debug' => true,
    'placement' => 'top',
    'content' => '提示文字',
    'delay' => 1000, //延时

);

$PopTipTipData = array(
    'debug' => true,
    'placement' => 'top',
    'model' => 'visibile',
    'confirm' => array(
        'okText' => 'ok',
        'cancelText' => 'cancel',
        'onOk' => 'POk',
        'onCancel' => 'Pcancel',
        'title' => '确定？',
    ),
);

$carousel = array(
    'debug' => true,
    'autoplay' => 'autoplay1',
    'loop' => 'loop1',
    'arrow' => 'always',

    'radiusDot' => 'radiusdot1',
    'trigger' => 'hover',
    'model' => 'value3',
    'dots' => 'dots1',
    'carouselItem' => array(
        "<div class='demo-carousel'>测试1</div>", "<div class='demo-carousel'>测试2</div>", "<div class='demo-carousel'>测试3</div>", "<div class='demo-carousel'>测试完成</div>",
    ),
);

$treeData = array(
    'debug' => true,
    'showCheckbox' => true,
    'data' => array(
        array(
            'title' => '标题',
            'expand' => true,
            'selected' => true,
            'children' => array(
                array(
                    'title' => '标题1-1',
                    'expand' => true,
                    'children' => array(
                        array(
                            'title' => '标题1-1-1',
                        ),
                        array(
                            'title' => '标题1-1-2',
                        ),
                    ),
                ),
                array(
                    'title' => '标题1-1',
                    'children' => array(
                        array(
                            'title' => '标题1-1-1',
                        ),
                        array(
                            'title' => '标题1-1-2',
                        ),
                    ),
                ),

            ),

        ),
        array(
            'title' => '标题二',
            'childrend' => array(
                array(
                    'title' => '标题2v2',
                    'disable' => true,
                ),
                array(
                    'title' => '标题2v3',
                    'disable' => true,
                ),

            ),
        ),
    ),

);

$tabsData = array(
    'debug' => true,
    'size' => 'small',
//    'type' => 'card',
    'TabPane' => array(
        array(
            'label' => '标签1',
            'content' => '标签内容',
            'name' => 'name1',
        ),
        array(
            'label' => '标签2222',
            'content' => '标签内容222',
            'name' => 'name2',
            'disabled' => true,
        ),
        array(
            'label' => '标签33',
            'content' => '标签内容3333',
            'name' => 'name3',
        ),

    ),
);


$DropdownMenuData = array(
    'debug' => true,
    'dropdownmenu' => array(
        array('菜单一'), array('路打滚','disabled','devided'), array('豆汁儿'), array('冰糖葫芦'), array('北京烤鸭'), array('炸酱面')),

);

$this->title = '测试';
?>

<style>
    div: {
        margin: 10px 20px;
        width: 100px;
        width: 30%;
    }

    .demo-carousel {
        background: #df2525;
        color: #fff;
        font-size: 16px;
        height: 300px;
        line-height: 300px;
        font-weight: 900;
        text-align: center;
    }
</style>


<div id="DropdownMenu">
    <?= DropdownMenu::widget(['message' => '标签页', 'config' => $DropdownMenuData]); ?>
</div>

<div id="Tabs">
    <?= Tabs::widget(['message' => '标签页', 'config' => $tabsData]); ?>
</div>

<div id="Tree">
    <?= Tree::widget(['message' => '跑马灯', 'config' => $treeData]); ?>
</div>

<div id="Carousel">
    <?= Carousel::widget(['message' => '跑马灯', 'config' => $carousel]); ?>
</div>

<div id="PopTip">
    <?= PopTip::widget(['message' => '<i-button>Poptip提示</i-button>', 'config' => $PopTipTipData]); ?>
</div>

<div id="ToolTip">
    <?= ToolTip::widget(['message' => 'Tooltip提示', 'config' => $toolTipData]); ?>
</div>

<div id="Tag">
    <?= Tag::widget(['message' => 'timeline1', 'config' => $tagData]); ?>
</div>

<div id="TimeLine">
    <?= TimeLine::widget(['message' => 'timeline1', 'config' => $timelineData]); ?>
</div>


<div id="collapseDemo">

</div>


<div id="Collapse" style="width:30%;">

    <?php Collapse::begin(['config' => $CollapseDemo, 'message' => '头像小部件']); ?>
    <?= Collapse::addPane('1', '标题', '内容') ?>
    <?= Collapse::addPane('2', '百度·乔布斯', '史蒂夫·乔布斯（Steve Jobs），1955年2月24日生于美国加利福尼亚州旧金山，美国发明家、企业家、美国苹果公司联合创办人。ry Wozniak），美国电脑工程师，曾与史蒂夫·乔布斯合伙创立苹果电脑（今之苹果公司）。斯蒂夫·盖瑞·沃兹尼亚克曾就读于美国科罗拉多大学，后转学入美国著名高等学府加州大学伯克利分校（UC Berkeley）并获得电机工程及计算机（EECS）本科学位（1987年）') ?>
    <?php Collapse::end(); ?>

</div>

<div id="FormWidget" style="width:30%;">
    <?php Form::begin(['config' => $formDataDemo]); ?>
    <form-item>
        <i-input v-model="formModel.name"></i-input>
        {{formModel.name}}
    </form-item>
    <form-item>
        <div id="input">
            <p style="width:30%;"><?= Input::widget(['message' => 'input测试', 'config' => $demoInput]); ?></p>
        </div>
    </form-item>
    <?php Form::end(); ?>
</div>

<div id="Badge">
    <?= Badge::widget(['config' => $BadgeDemo, 'message' => '头像小部件']); ?>
</div>


<div id="Avatar">
    <?= Avatar::widget(['config' => $AvatarDemo, 'message' => '头像小部件']); ?>
</div>


<div id="Progress">
    <?= Progress::widget(['config' => $ProgressDemo, 'message' => '进度条']); ?>
</div>


<div id="Modal">
    <?= Modal::widget(['config' => $ModalDemo, 'message' => 'ModalDemo对话框']); ?>{{model1}}
</div>


<div id="Notice">
    <?= Notice::widget(['config' => $NoticeDemo, 'message' => 'Notice事件']); ?>
</div>

<div id="Message">
    <?= Message::widget(['config' => $messageDemo, 'message' => 'Message事件']); ?>
</div>

<div id="AlertWidget">
    <?= AlertWidget::widget(['config' => $alertDemo]); ?>
</div>

<div id="Card">
    <?= Card::widget(['config' => $cardDemo]); ?>
</div>

<!--Select-->
<div id="select">
    <p style="width:30%;">
        <?= Select::widget(['message' => 'select列表', 'config' => $demoSelect]); ?>
    </p>
    <br>
</div>
<br><br>


<!--ColorPicker-->
<div id="ColorPicker" style="width:30%;">
    <?= ColorPicker::widget(['message' => 'select列表', 'config' => $demoColorPickerData]); ?>
</div>


<div id="Upload" style="width:30%;">
    <?= Upload::widget(['message' => 'select列表', 'config' => $demoUploadData]); ?>
</div>

<!--Rate-->
<div id="Rate">
    <p style="width:30%;">
        <?= Rate::widget(['message' => 'select列表', 'config' => $demoRateData]); ?>
    </p>
    <br>
</div>

<!--InputNumber-->
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

<!--Menu-->
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

<div id="cascader">
    <p style="width:30%;">
        <?= Cascader::widget(['message' => 'select列表', 'config' => $demoCascadeData]); ?>
    </p>
</div>


<div id="table" style="width:30%;height:200px;">
    <?= Table::widget(['message' => 'table测试', 'data' => $demoTable, 'config' => array('debug' => true)]); ?>
</div>

<?php $this->beginBlock('vue'); ?>
new Vue({
el:'#collapseDemo',
data:{
value1:'1',
}
});
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['vue'], \yii\web\View::POS_END); ?>

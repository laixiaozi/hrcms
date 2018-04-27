<?php

use app\widget\iview\test;
use app\widget\iview\test2;
use app\widget\iview\Button;
use app\widget\iview\Menu;
use app\widget\iview\Icon;
use app\widget\iview\Input;
use app\widget\iview\Radio;

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
    'icon' => 'search',
    'size' => 'large',
    'clearable' => 'clearable',
//    'type'=>'textarea',
//    'rows' => '9',
    'slot' => '<span slot="append" >Http://</span>',
    'slot' => '<span slot="prepend" >Search</span>',
//    'disabled' => 'disabled',
);

$demoRadio = array(
    'mode' => 'demoRadio',
);

$demoRadio2 = array(
    'items' => array(
        'parameters' => array('model' => 'radioGroupmodel' , 'vertical'=> 'vertical'),
        'list' => array(
            array('label' => 'radio2', 'icon' => 'social-android', 'text' => '显示的文字'),
            array('label' => 'radio3', 'icon' => 'social-android', 'text' => '显示的文字22'),
        ),
    ),
);

$this->title = '测试';
?>

<div style="height:300px;">
    <?= menu::widget(['menuData' => $demoMenu, 'event' => 'on-select', 'eventName' => 'func']) ?>

    <?= Icon::widget(['icon' => rand(0, 700)]); ?>
    <p style="width:30%;"><?= Input::widget(['message' => 'input测试', 'config' => $demoInput]); ?></p>
    <p style="width:30%;"><?= Radio::widget(['message' => 'input测试', 'config' => $demoRadio]); ?></p>
    <p style="width:30%;"><?= Radio::widget(['message' => 'radio测试2', 'config' => $demoRadio2]); ?></p>

</div>


<?php $this->beginBlock('vue'); ?>
console.log('d');
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['vue'], \yii\web\View::POS_END); ?>

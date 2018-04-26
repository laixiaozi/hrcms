<?php

use app\widget\iview\test;
use app\widget\iview\test2;
use app\widget\iview\button;
use app\widget\iview\menu;
use app\widget\iview\icon;

$demoMenu = array(
    ['name' => 'required', 'text' => '测试', 'icon' => 'leaf'],
    ['name' => 'required2', 'text' => '测试22', 'icon' => 'heart'],
    ['name' => 'required3', 'text' => '测试22', 'icon' => 'heart' , 'title' => '子菜单标题', 'items' => [
        ['name' => 'required2-1', 'text' => '测试22', 'icon' => 'heart'],
        ['name' => 'required2-2', 'text' => '测试22', 'icon' => 'heart'],
        ['name' => 'required2-3', 'text' => '测试22', 'icon' => 'heart'],
    ],
    ],
);
$this->title = '测试';
?>

<div style="height:300px;">
    <?= menu::widget(['menuData' => $demoMenu, 'event' => 'on-select', 'eventName' => 'func']) ?>

    <?= icon::widget(['icon' => rand(0, 700)]); ?>
</div>



<?php $this->beginBlock('vue'); ?>
console.log('d');
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['vue'], \yii\web\View::POS_END); ?>

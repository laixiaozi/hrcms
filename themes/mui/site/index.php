<?php

use yii\helpers\Html;
use app\widget\mui\MuiHeader;
use app\widget\mui\MuiAccordion;
use app\widget\mui\MuiActionSheet;
use app\widget\mui\MuiBrage;
use app\widget\mui\MuiButton;
use app\widget\mui\MuiCardView;
use app\widget\mui\MuiCheckBox;
use app\widget\mui\MuiDialog;
use app\widget\mui\Muigallery;
use app\widget\mui\MuiGrid;
use app\widget\mui\MuiIcon;
use app\widget\mui\MuiInput;
use app\widget\mui\MuiList;
use app\widget\mui\MuiMask;
use app\widget\mui\MuiNumberBox;
use app\widget\mui\MuiOffcanvas;
use app\widget\mui\MuiPopover;
use app\widget\mui\MuiPicker;
use app\widget\mui\MuiDatePicker;
use app\widget\mui\MuiRadio;
use app\widget\mui\MuiRange;
use app\widget\mui\MuiScroll;
use app\widget\mui\MuiSlide;
use app\widget\mui\MuiSwitch;
?>

<?= MuiHeader::widget(['title' => '测试导航', 'back' => true]); ?>
<div class="mui-content">

    <?= Muigallery::widget(['title' => '滚动图片']); ?>
    <br>
    <?= MuiList::widget(['title' => '列表']); ?>
    <br><br>
    <?= MuiAccordion::widget(['title' => '折叠面板', 'show' => true]); ?>
    <br>
    <?= MuiActionSheet::widget(['title' => '弹出菜单', 'show' => true]); ?>
    <br><br>
    <?= MuiBrage::widget(['title' => '数字角标', 'show' => true]); ?>
    <br><br>
    <?= MuiButton::widget(['title' => '按钮', 'show' => true]); ?>
    <br><br>
    <?= MuiCardView::widget(['title' => '卡片视图']); ?>
    <br> <br>
    <?= MuiCheckBox::widget(['title' => '复选框']); ?>
    <br><br>
    <?= MuiDialog::widget(['title' => '弹框']); ?>
    <br><br>
    <?= MuiGrid::widget(['title' => '栅格化']); ?>
    <br><br>
    <?= MuiInput::widget(['title' => 'input']); ?>
    <br><br>
    <?= MuiIcon::widget(['title' => '小图标']); ?>
    <br><br>
    <?= MuiMask::widget(['title' => '小图标']); ?>
    <br><br>
    <?= MuiNumberBox::widget(['title' => '数字输入框']); ?>
    <br><br>
    <?= MuiPopover::widget(['title' => '弹出菜单']); ?>
    <br><br>
    <?= MuiPicker::widget(['title' => '选择器']); ?>
    <br><br>
    <?= MuiDatePicker::widget(['title' => '日期选择器']); ?>
    <br><br>
    <?= MuiRadio::widget(['title' => '单选按钮']); ?>
    <br><br>
    <?= MuiRange::widget(['title' => '滑块']); ?>
    <br><br>
    <?= MuiSlide::widget(['title' => '滑动']); ?>
    <br><br>
    <?= MuiSwitch::widget(['title' => '滑动']); ?>
    <br><br>



</div>
<br><br>
<?= MuiOffcanvas::widget(['title' => '侧滑菜单']); ?>
<br><br><br><br><br><br><br><br>
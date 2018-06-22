<?php

use app\widget\mui\MuiHeader;
use app\widget\mui\MuiInput;
use app\widget\mui\MuiForm;
use yii\helpers\Url;
use app\widget\mui\MuiButton;

?>
<?= MuiHeader::widget(['title' => '注册页面']) ?>
<div class="mui-content">
    <br>
    <?php MuiForm::begin() ?>
    <?= MuiInput::widget(['config' => array('name' => 'username', 'label' => '用户名', 'placeholder' => '请输入用户名')]) ?>
    <?= MuiInput::widget(['type' => 'password', 'config' => array('name' => 'usepasswd', 'label' => '密码', 'placeholder' => '请输入密码')]) ?>
    <?= MuiInput::widget(['config' => array('name' => 'captcha', 'placeholder' => '请输入验证码', 'label' => '<img src="' . Url::toRoute(['site/captcha']) . '" style="height:30px;" />')]) ?>
    <?= MuiButton::widget(['inform' => true,]); ?>
    <?php MuiForm::end(); ?>
</div>

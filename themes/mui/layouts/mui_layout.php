<?php
//加载常用的组件模块
use yii\helpers\Html;
use app\assets\MuiAsset;
MuiAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody(); ?>
<?= $content ?>
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->beginBlock('aa'); ?>
mui.init();
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['aa'], \yii\web\View::POS_END); ?>
<?php $this->endPage(); ?>




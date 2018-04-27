<?php
//加载常用的组件模块
use yii\helpers\Html;
use app\assets\IviewAsset;
use app\widget\iview\menu;

IviewAsset::register($this);
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

<div id="layout">

        <Layout>
            <Header>
                <?=menu::widget(['menuData' => ''])?>
            </Header>
             <Layout>
<!--            <Sider></Sider>-->
            <Content><?= $content ?></Content>
             </Layout>
            <Footer></Footer>
        </Layout>
</div>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->beginBlock('aa'); ?>
  var layout = new Vue({
    el:'#layout',
    data:{
       demoInput:'',
       demoRadio:'',
       radioGroupmodel:'',
    },

    methods:{
        func:function(e){
         console.log(e);
        }
    }

  });
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['aa'], \yii\web\View::POS_END); ?>
<?php $this->endPage(); ?>




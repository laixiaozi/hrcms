<?php

use app\widget\iview\test;
use app\widget\iview\test2;
use app\widget\iview\button;

$this->title = '测试';
?>

<div id="app">
    <?=button::widget(['btntype' => 'success' , 'btntxt' => '测试模块']);?>
</div>

<?php $this->beginBlock('vue');?>
  new Vue({
         el:'#app',
         data:{

         }
});
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['vue'] ,  \yii\web\View::POS_END ); ?>

<?php  $this->beginBlock('search'); ?>
    mui.alert('<?=$msg?>','',function(){
     window.location.href = '<?=$go?>';
   });
<?php $this->endBlock()?>
<?php $this->registerJs($this->blocks['search'] ,  yii\web\View::POS_END); ?>


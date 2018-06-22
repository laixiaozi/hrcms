<?php
/*
 * 公共菜单
*/
use app\widget\mui\MuiSlide;
use app\widget\mui\MuiList;
use app\widget\mui\MuiGallery;
use app\widget\mui\MuiGridNine;

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
?>

<?= MuiGridNine::widget(array(
    'items' => [
        array('icon' => 'mui-icon mui-icon-home', 'label' => '首页', 'href' => Url::to(['/job'])),
        array('icon' => 'mui-icon mui-icon-chat', 'label' => '留言', 'href' => '#'),
        array('icon' => 'mui-icon mui-icon-navigate', 'label' => '导航', 'href' => Url::to(['/job/map'])),
    ],
)) ?>

<?php $this->beginBlock('home'); ?>
        mui.ready(function(){
        mui.init();
        if(mui.os.wechat == 'undefind' || mui.os.wechat == null){
            //console.log('非微信环境');
         }else{
           //console.log('微信环境');
         }
        mui('.mui-grid-view').on('tap', 'li', function(e){
           var hrf = this.children[0].getAttribute('href');
           if(hrf == '#'){
              mui.alert('暂未开放');
           }
           window.location.href= hrf;
        });
});
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['home'], \yii\web\View::POS_END); ?>

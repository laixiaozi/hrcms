<?php
/**
 * 公共底部
 */

use app\widget\mui\MuiBar;
use yii\helpers\Url;

?>
<?= MuiBar::widget([
    'config' => [
        'items' => [
            ['label' => '首页', 'href' => Url::to(['/job']), 'icon' => 'mui-icon mui-icon-home'],
            ['label' => '列表页面', 'href' => Url::to(['/job/list']), 'icon' => 'mui-icon mui-icon-list' ,'active'=>true],
            ['label' => '搜索', 'href' => Url::to(['/job/search']), 'icon' => 'mui-icon mui-icon-search'],
        ]
    ],
]); ?>

<?php $this->beginBlock('home'); ?>
    mui.ready(function(){
        mui.init();
        mui('.mui-bar-tab').on('tap', 'a', function(e){
           var hrf = this.getAttribute('href');
           if(hrf.indexOf('javascript') === -1){
             console.log('跳转页面');
              window.location.href=hrf;
           }
       });
    });
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['home'], \yii\web\View::POS_END); ?>


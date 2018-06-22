<?php

use app\widget\mui\MuiOffcanvas;
use app\widget\mui\MuiBar;
use app\widget\mui\MuiSlide;
use app\widget\mui\MuiList;
use app\widget\mui\MuiGallery;
use app\widget\mui\MuiGridNine;
use app\widget\mui\MuiAccordionItem;
use app\widget\mui\MuiAccordion;
use yii\helpers\Url;


//<?= MuiBar::widget()
?>

<?php MuiOffcanvas::begin(['title' => 'Mui框架    ']); ?>
<?= $this->render('Menu'); ?>
<?= MuiGallery::widget() ?>
<?php MuiAccordion::begin(); ?>
<?php MuiAccordionItem::begin(['title' => '最新', 'show' => true]); ?>
<?= MuiList::widget(['items' => $joblist]) ?>
<?php MuiAccordionItem::end(); ?>
<?php MuiAccordion::end(); ?>
<?php MuiOffcanvas::end(); ?>


<?php $this->beginBlock('home'); ?>
    mui.ready(function(){
        mui.init();
        mui('.mui-table-view').on('tap', '.mui-table-view-cell .mui-media', function(e){
                   window.location.href=this.children[0].getAttribute('href');
        });
    });





<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['home'], \yii\web\View::POS_END); ?>





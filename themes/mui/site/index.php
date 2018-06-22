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
<?php MuiOffcanvas::begin(['title' => '首页测试标题']); ?>
<?= MuiGridNine::widget(array(
    'items' => [
        array('icon' => 'mui-icon mui-icon-home', 'label' => '首页', 'href' => Url::to(['/site/reg'])),
        array('icon' => 'mui-icon mui-icon-chat', 'label' => '留言', 'href' => Url::to(['/site/personal'])),
        array('icon' => 'mui-icon mui-icon-navigate', 'label' => '导航', 'href' =>Url::to(['/site/personal' , true])),
    ],
)) ?>
<?= MuiGallery::widget() ?>

<?php MuiAccordion::begin(); ?>
<?php MuiAccordionItem::begin(['title' => '最新', 'show' => true]); ?>
<?= MuiList::widget(['items' => array(
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-home'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-chat'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']) , 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-navigate'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-home'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-chat'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']) , 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-navigate'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-home'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-chat'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']) , 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-navigate'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-home'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-chat'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']) , 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-navigate'),array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-home'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']), 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-chat'),
    array('title' => 'test', 'href' => Url::to(['/site/personal']) , 'desc' => 'testaaa', 'icon' => 'mui-icon mui-icon-navigate'),
)]) ?>

<?php MuiAccordionItem::end(); ?>
<?php MuiAccordion::end(); ?>

<?php MuiOffcanvas::end(); ?>





<?php
/**
 * 详情页面
 */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\widget\mui\MuiBar;
use app\widget\mui\MuiList;
use app\widget\mui\MuiGallery;
use app\widget\mui\MuiAccordionItem;
use app\widget\mui\MuiAccordion;

?>
<?php if (isset($data)): ?>
    <?= \app\widget\mui\MuiHeader::widget(['title' => $data[0]['job_title'] ,'back'=> true]); ?>
    <div class="mui-content">
       <?php MuiAccordion::begin()?>
         <?php MuiAccordionItem::begin()?>
            <p style="pading:10px auto;">发布时间： <?= $data[0]['job_add_time'] ?> </p>
            <div style="margin-top:20px; padding:20px auto;">
                <?= $data[0]['job_desc'] ?>
            </div>
        <?php MuiAccordionItem::end();?>
        <?php MuiAccordion::end()?>
        <br><br>
        <?php MuiAccordion::begin(['id'=>'morelist' ])?>
        <?php MuiAccordionItem::begin(['show'=> true, 'title' => '相关'])?>
            <?=MuiList::widget([
                'items' => $joblist
            ])?>
        <?php MuiAccordionItem::end();?>
        <?php MuiAccordion::end()?>
    </div>
<?php endif; ?>
<?=$this->render('footer')?>


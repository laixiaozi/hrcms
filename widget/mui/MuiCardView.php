<?php

namespace app\widget\mui;

/**
 * 卡片视图
 */
use Yii;
use yii\base\Widget;

class MuiCardView extends Widget
{

    public $title;

    public $media;

    public $mediabody;

    public $view;

    public function init()
    {
        parent::init();
        if (empty($this->title)) {
            $this->title = '测试标题';
        }
        if (empty($this->view)) {
            $this->view = Yii::$app->getView();
        }

    }

    public function run()
    {
        return $this->getCode();
    }

    /**
     *<div class="mui-card-header mui-card-media" style="height:40vw;background-image:url(../images/cbd.jpg)"></div>
     */
    public function getCode()
    {
        $media = '';
        $mediabody = '';
        if ($this->media == true) {
            $media = 'mui-card-media';
        }
        if ($this->mediabody == true) {
            $mediabody = 'mui-media-body';
        }
        $code = <<<COD
            <div class="mui-card">
            <!--页眉，放置标题-->
            <div class="mui-card-header {$media}">
              <div class="{$mediabody}">页眉</div>
            </div>
            <!--内容区-->
            <div class="mui-card-content">
              <p style="padding:10px;">卡片页眉及内容区，均支持放置图片； 页眉放置图片的话，需要在.mui-card-header节点上增加.mui-card-media类，然后设置一张图片做背景图即可，代码如下：</p>
              <p style="padding:10px;">若希望在页眉放置更丰富的信息，比如头像、主标题、副标题，则需使用.mui-media-body类，示例代码如下</p>
            </div>
            <!--页脚，放置补充信息或支持的操作-->
            <div class="mui-card-footer">页脚</div>
        </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
         // var st = document.getElementById('showactionsheet');
         //  st.addEventListener('click',function(e){
         //       console.log('点击显示');
         //  });
          mui("body").on('click', '#showactionsheet' , function(){
              mui("#sheet1").popover('toggle'); 
          });
          
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



<?php

namespace app\widget\mui;

/**
 * 图标
 */
use Yii;
use yii\base\Widget;

class MuiIcon extends Widget
{

    public $title;

    public $show;

    public $view;

    public $iconList;

    public function init()
    {
        parent::init();
        if (empty($this->title)) {
            $this->title = '测试标题';
        }
        if (empty($this->view)) {
            $this->view = Yii::$app->getView();
        }
        $this->iconList = array(
            'mui-icon mui-icon-contact',
            'mui-icon mui-icon-person',
            'mui-icon mui-icon-personadd',
            'mui-icon mui-icon-phone',
            'mui-icon mui-icon-email',
            'mui-icon mui-icon-chatbubble',
            'mui-icon mui-icon-chatboxes',
            'mui-icon mui-icon-weibo',
            'mui-icon mui-icon-weixin',
            'mui-icon mui-icon-pengyouquan',
            'mui-icon mui-icon-chat',
            'mui-icon mui-icon-qq',
            'mui-icon mui-icon-videocam',
            'mui-icon mui-icon-camera',
            'mui-icon mui-icon-image',
            'mui-icon mui-icon-mic',
            'mui-icon mui-icon-micoff',
            'mui-icon mui-icon-location',
            'mui-icon mui-icon-map',
            'mui-icon mui-icon-compose',
            'mui-icon mui-icon-trash',
            'mui-icon mui-icon-upload',
            'mui-icon mui-icon-download',
            'mui-icon mui-icon-close',
            'mui-icon mui-icon-closeempty',
            'mui-icon mui-icon-redo',
            'mui-icon mui-icon-undo',
            'mui-icon mui-icon-refresh',
            'mui-icon mui-icon-refreshempty',
            'mui-icon mui-icon-reload',
            'mui-icon mui-icon-loop',
            'mui-icon mui-icon-spinner mui-spin',
            'mui-icon mui-icon-spinner-cycle mui-spin',
            'mui-icon mui-icon-star',
            'mui-icon mui-icon-starhalf',
            'mui-icon mui-icon-plus',
            'mui-icon mui-icon-plusempty',
            'mui-icon mui-icon-minus',
            'mui-icon mui-icon-checkmarkempty',
            'mui-icon mui-icon-search',
            'mui-icon mui-icon-home',
            'mui-icon mui-icon-navigate',
            'mui-icon mui-icon-gear',
            'mui-icon mui-icon-settings',
            'mui-icon mui-icon-list',
            'mui-icon mui-icon-bars',
            'mui-icon mui-icon-paperplane',
            'mui-icon mui-icon-info',
            'mui-icon mui-icon-help',
            'mui-icon mui-icon-locked',
            'mui-icon mui-icon-more',
            'mui-icon mui-icon-flag',
            'mui-icon mui-icon-paperclip',
            'mui-icon mui-icon-paperclip',
            'mui-icon mui-icon-forward',
            'mui-icon mui-icon-arrowup',
            'mui-icon mui-icon-arrowdown',
            'mui-icon mui-icon-arrowleft',
            'mui-icon mui-icon-arrowright',
            'mui-icon mui-icon-arrowthinup',
            'mui-icon mui-icon-arrowthindown',
            'mui-icon mui-icon-arrowthinleft',
            'mui-icon mui-icon-arrowthinright',
            'mui-icon mui-icon-pulldown',
        );
    }

    public function run()
    {
        return $this->getCode();
    }

    public function getCode()
    {
        $code = '<div>';
//        $code .='<div class="mui-row">';
        for ($i = 0; $i < count($this->iconList); $i++) {
//            if($i >0 && $i % 4 == 0){
//                $code .='</div><div class="mui-row"';
//            }
            $code .= '<span class="  ' . $this->iconList[$i] . '"></span>' . PHP_EOL;
        }

        $code .= '</div>';
//        $code .= '</div>';
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



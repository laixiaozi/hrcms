<?php

namespace app\widget\mui;

/**
 * 顶部菜单
 */
use Yii;
use yii\base\Widget;

class MuiHeader extends Widget
{

    public $title;

    public $back;

    public function init()
    {
        parent::init();
        if (empty($this->title)) {
            $this->title = '测试标题';
        }
    }

    public function run()
    {
        return $this->getCode();
    }

    public function getCode()
    {
        $back = ' ';  //是否具有返回功能
        if($this->back == true){
            $back = '<a class=" mui-action-back mui-icon mui-icon-left-nav mui-pull-left"></a>';
        }
        $code = <<<COD
        <header id="header" class="mui-bar mui-bar-nav ">
			{$back}
			<h1 class="mui-title">{$this->title}</h1>
		</header>
COD;
        return $code;
    }


}



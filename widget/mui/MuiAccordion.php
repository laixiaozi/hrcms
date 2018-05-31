<?php

namespace app\widget\mui;

/**
 * 折叠菜单
 */
use Yii;
use yii\base\Widget;

class MuiAccordion extends Widget
{

    public $title;

    public $show;

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
        $show = ' ';  //是否具有返回功能
        if ($this->show == true) {
            $show = 'mui-active';
        }
        $code = <<<COD
        <ul class="mui-table-view"> 
        <li class="mui-table-view-cell mui-collapse  {$show}">
            <a class="mui-navigate-right" href="#">面板1</a>
            <div class="mui-collapse-content">
                <p>面板1子内容</p>
            </div>
        </li>
    </ul>
COD;
        return $code;
    }


}



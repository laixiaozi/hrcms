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

    public $id;

    public function init()
    {
        parent::init();
        if (empty($this->title)) {
            $this->title = '测试标题';
        }

        if (empty($this->id)) {
            $this->id = 'mui-accordion';
        }
        ob_start();
    }

    public function run()
    {
        $code = $this->getCode();
        $code .= ob_get_clean();
        $code .= '</ul>' . PHP_EOL;
        return $code;
    }

    public function getCode()
    {
        $code = '<ul class="mui-table-view " id="'.$this->id.'" >' . PHP_EOL;
        return $code;
    }


}



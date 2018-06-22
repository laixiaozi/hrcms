<?php

namespace app\widget\mui;

/**
 * 折叠菜单
 */
use Yii;
use yii\base\Widget;

class MuiAccordionItem extends Widget
{

    public $title;

    public $show;

     public $id;


    public function init()
    {
        if(empty($this->id)){
            $this->id='accordion-item';
        }
        parent::init();
        ob_start();
    }

    public function run()
    {
        $code = $this->getCode();
        $code .= ob_get_clean();
        if ($this->show || $this->title) {
            $code .= '</div>' . PHP_EOL;
        }
        $code .= '</li>' . PHP_EOL;
        return $code;
    }

    public function getCode()
    {
        $showCode = '';
        if ($this->show) {
            $showCode = 'mui-active';
        }
        $code = '<li class="mui-table-view-cell mui-collapse ' . $showCode . '"  id="'.$this->id.'">' . PHP_EOL;
        if ($this->title) {
            $code .= '<a class="mui-navigate-right" href="#">' . $this->title . '</a>' . PHP_EOL;
        }
        if ($this->show ||  $this->title) {
            $code .= '<div class="mui-collapse-content">' . PHP_EOL;
        }
        return $code;
    }


}



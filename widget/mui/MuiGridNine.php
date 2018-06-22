<?php

namespace app\widget\mui;


use Yii;
use yii\base\Widget;

class MuiGridNine extends Widget
{


    public $view;

    public $items;

    public function init()
    {
        parent::init();

        if (empty($this->view)) {
            $this->view = Yii::$app->getView();
        }
    }

    public function run()
    {
        return $this->getCode();
    }

    public function getCode()
    {
        $code = '<ul class="mui-table-view mui-grid-view mui-grid-9">' . PHP_EOL;
        if (is_array($this->items)) {
            foreach ($this->items as $item) {
                $href = isset($item['href']) ? $item['href'] : '';
                $icon = isset($item['icon']) ? $item['icon'] : '';
                $label = isset($item['label']) ? $item['label'] : '';
                $code .= ' <li class="mui-table-view-cell mui-media mui-col-xs-4 mui-col-sm-3">' . PHP_EOL;
                $code .= '<a href="' . $href . '">' . PHP_EOL;
                $code .= ' <span class="' . $icon . '"></span>' . PHP_EOL;
                $code .= ' <div class="mui-media-body">' . $label . '</div>' . PHP_EOL;
                $code .= ' </a>' . PHP_EOL;
                $code .= ' </li>' . PHP_EOL;
            }
        }
        $code .= '</ul>' . PHP_EOL;
        return $code;
    }


}



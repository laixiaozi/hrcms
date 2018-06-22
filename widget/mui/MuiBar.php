<?php

namespace app\widget\mui;

/**
 * 底部菜单
 */
use Yii;
use yii\base\Widget;

class MuiBar extends Widget
{

    public $config;

    public function init()
    {
        parent::init();
    }

    public function run()
    {
        return $this->getCode();
    }

    public function getCode()
    {
        $code = '<nav class="mui-bar mui-bar-tab ">' . PHP_EOL;
        if (isset($this->config['items'])) {
            foreach ($this->config['items'] as $item) {
                $code .= '<a class="mui-tab-item';

                if (isset($item['active'])) {
                    $code .= ' mui-active'. PHP_EOL;
                }
                $code .=' "';

                if (isset($item['href'])) {
                    $code .= ' href="' . $item['href'] . '">'. PHP_EOL;
                }else{
                    $code .= ' href="javascript:;">'. PHP_EOL;
                }

                if (isset($item['icon'])) {
                    $code .= ' <span class="'.$item['icon'].'"></span>'. PHP_EOL;
                }
                if (isset($item['label'])) {
                    $code .= ' <span class="mui-tab-label">'.$item['label'].'</span>'. PHP_EOL;
                }else{
                    $code .= ' <span class="mui-tab-label">Label</span>'. PHP_EOL;
                }
                $code .= '</a>'. PHP_EOL;
            }
        }
        $code .= '</nav>' . PHP_EOL;
        return $code;
    }


}



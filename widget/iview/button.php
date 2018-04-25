<?php

namespace app\widget\iview;

use  yii\helpers\html;
use yii\base\Widget;

/**
 * iview 生成button
 */
class button extends Widget
{
    public $btntxt;
    public $btntype;
    private $btntypeList = array('primary', 'ghost', 'dashed', 'text', 'info', 'success', 'warning', 'error');

    public function init()
    {
        parent::init();
        if (is_null($this->btntxt)) {
            $this->btntxt = '按钮';
        }
    }


    public function run()
    {
        $btntype = '';
        if (!is_null($this->btntype) && in_array($this->btntype, $this->btntypeList)) {
            $btntype = 'type=' . $this->btntype;
        }
        return '<i-button ' . $btntype . '>' . $this->btntxt . '</i-button>';
    }

}
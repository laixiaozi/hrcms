<?php

namespace app\widget\mui;

/**
 * 文本输入框
 * 所有包裹在.mui-input-row 类中的 input、textarea等元素都将被默认设置宽度属性为width: 100%; 。 将 label 元素和上述控件控件包裹在.mui-input-group中可以获得最好的排列。
 * 搜索框：在.mui-input-row同级添加.mui-input-search 类，就可以使用search控件
 * 快速删除：只需要在input控件上添加.mui-input-clear类，当input 控件中有内容时，右侧会有一个删除图标，点击会清空当前input的内容；
 * 语音输入*5+ only：为了方便快速输入，mui集成了 HTML5+的语音输入，只需要在对应input控件上添加.mui-input-speech 类，就可以在5+环境下使用语音输入
 */
use Yii;
use yii\base\Widget;

class MuiInput extends Widget
{

    public $type;

    public $view;

    public $config = array();

    public function init()
    {
        parent::init();
        if (empty($this->type)) {
            $this->type = 'text';
        }
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
        $label = isset($this->config['label']) ? trim($this->config['label']) : '字段';
        $name = isset($this->config['name']) ? 'name="' . trim($this->config['name']) . '""' : '';
        $placeholder = isset($this->config['placeholder']) ? trim($this->config['placeholder']) : '请输入..';
        $id = isset($this->config['id']) ? 'id = "' . trim($this->config['id']) . '""' : ' ';
        $password = $this->type == 'password' ? 'mui-input-password' : '';
        $clean = $this->type == 'password' ? ' ' : 'mui-input-clear';
        if ($this->config['type'] == 'search') {
            $code = <<<COD
                <div class="mui-input-row mui-search">
                    <input type="{$this->type}" class=" $clean   $password" placeholder="{$placeholder}" {$id} {$name} />
                </div>
COD;
        } else {
            $code = <<<COD
                <div class="mui-input-row">
                    <label>{$label}</label>
                    <input type="{$this->type}" class=" $clean   $password" placeholder="{$placeholder}" {$id} {$name} />
                </div>
COD;
        }

        return $code;
    }

}



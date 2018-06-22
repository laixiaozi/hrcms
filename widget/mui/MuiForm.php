<?php

namespace app\widget\mui;

/**
 *Form表单控件
 */
use Yii;
use yii\base\Widget;

class MuiForm extends Widget
{

    public $view;

    public $config;

    public function init()
    {
        parent::init();

        if (empty($this->view)) {
            $this->view = Yii::$app->getView();
        }
        ob_start();
    }

    public function run()
    {
        $code = $this->beforeCode();
        $code .= ob_get_clean();
        $code .= $this->endCode();
        return $code;
    }


    public function beforeCode()
    {
        $method = isset($this->config['method']) ? trim($this->config['method']) : 'get';
        $action = isset($this->config['action']) ? 'action= "'.trim($this->config['action']) . '"' : '';
        $enctype = isset($this->config['enctype']) ? trim($this->config['enctype']) : 'application/x-www-form-urlencoded';
        $code = <<<FOM
           <form class="mui-input-group" method="{$method}" {$action}  enctype="{$enctype}">
FOM;
        return $code;
    }

    public function endCode()
    {
        $code = <<<FOM
          </form>
FOM;
        return $code;
    }

}



<?php

namespace app\modules\generate\controllers;

use yii\web\Controller;
use Yii;
use yii\helpers\Html;

/**
 * Default controller for the `modules` module
 * 用来生成iview的widget类文件
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }


    public function actionWidget()
    {
        $request = Yii::$app->request;
        $widgetExtension = '.php';
        $widgetFloder = Yii::getAlias('@app') . '/widget/iview';
        $widgetName = $request->get('widgetName');
        $tplType = $request->get('tplType');
        $templateName = 'test.tpl';
        //begin end模式的模板
        if (!is_null($tplType) && !empty($tplType)) {
            $templateName = 'test2.tpl';
        }
        $template = $widgetFloder . '/' . $templateName;

        if (!is_null($widgetName) && !empty($widgetName)) {
            $widgetName = ucfirst(trim($widgetName));
            $widgetFile = $widgetFloder . '/' . $widgetName . $widgetExtension;
            //模板文件是否存在
            if (!file_exists($template)) {
                exit($template . '<br.模板文件不存在!');
            }
            $tplCode = file_get_contents($template);
            $classCode = str_replace(array('{className}'), array($widgetName), $tplCode);
            //写入文件
            $w = $this->writeFile($widgetFile, $classCode);
            print_r($w);
        } else {
            echo '请输入挂件名称';
        }

    }

    /**
     * 将代码写入指定的文件
     */
    public function writeFile($widgetFile, $code, $rewrite = false)
    {
        if (!is_writeable(dirname($widgetFile))) {
            return array('status' => false, 'message' => $widgetFile . '文件不可写');
        }
        if (file_exists($widgetFile) && $rewrite == false) {
            return $this->_return(false, $widgetFile . '文件已经存在');
        }
        $res = file_put_contents($widgetFile, $code);
        if (!$res) {
            return $this->_return(false, '生成模板失败');
        }
        return $this->_return(true, 'ok');

    }


    /**
     *通用返回值方法
     */
    public function _return($status, $message)
    {
        return array('status' => $status, 'message' => Html::encode($message));
    }

}

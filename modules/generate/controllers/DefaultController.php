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

    public $enableCsrfValidation = false;

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


    /**
     *采集指定的网页
     */
    public function actionCurlGet()
    {

        $request = Yii::$app->request;
        $url = $request->get('url');
        echo $url;
        echo '<br>';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_COOKIESESSION, true);
        $body = curl_exec($ch);
        curl_close($ch);

        print_r($body);
    }

    /**
     * 解析 html格式，生成对应的数据
     * var reg = /<p[^>]*>(?:(?!<\/p>)[\s\S])*<\/p>/gi;
     * <table[^>]*>(.*?)</table>
     * 当前主要用来解析table格式
     */
    public function actionPregHtml()
    {
        $replace = array('/');
        $replace_str = array('\/');
        $request = Yii::$app->request;
        $fileName = trim($request->post('fileName'));
        $file = Yii::getAlias('@webroot') . '/reghtml/';
        if (!file_exists($file)) {
            mkdir($file);
        }
        $file .= $fileName . '.html';
        if ($request->isPost) {
            $code = trim($request->post('html'));
            $reg = trim($request->post('reg'));
            $regex = str_replace($replace, $replace_str, $reg);
            file_put_contents($file, $code . PHP_EOL . $regex);
            preg_match_all("/" . $regex . "/si", $code, $data);
            file_put_contents($file . '(1).html', print_r($data[0], true));
            $tableTotal = count($data[0]);
            $tableData = array();
            if ($tableTotal) {
                for ($i = 0; $i < $tableTotal; $i++) {
                    $trarr = array();
                    $trarr = $this->pregTable($data[0][$i]);
                    $tableData[$i][] = $trarr;
                }
            }

            $arrstr = $this->createArr($tableData);
            return $this->asJson($arrstr);
        } else {
            return $this->render('pregHtml');
        }
    }

    /**
     *解析table成为一个数组
     */
    private function pregTable($table)
    {
        $data = array();
        $regTr = "/<tr[^>]*>(.*?)<\/tr>/si";
        $regTd = "/<td[^>]*>(.*?)<\/td>/is";
        preg_match_all($regTr, $table, $trData);
        $tdTotal = count($trData[0]);
        if ($tdTotal) {
            for ($i = 0; $i < count($trData[0]); $i++) {
                $tdarr = array();
                preg_match_all($regTd, $trData[0][$i], $tdData);
                for ($td = 0; $td < count($tdData[0]); $td++) {
                    $tdarr[] = $tdData[0][$td];
                }
                $data[$i][] = $tdarr;
            }
        }
        return $data;

    }

    /**
     * 生成一个数组
     */
    public function createArr($table)
    {
        $arrstr = 'array(';
        $n = count($table);
        for ($i = 0; $i < $n; $i++) {
            $trlist = $table[$i][0];
            if (count($trlist) > 0) {
                for ($p = 0; $p < count($trlist); $p++) {
                    $tdlist = $trlist[$p][0];
                    $name = isset($tdlist[0]) && !empty($tdlist[0]) ? trim($tdlist[0]) : '';
                    $desc = isset($tdlist[1]) && !empty($tdlist[1]) ? trim($tdlist[1]) : '';
                    $type = isset($tdlist[2]) && !empty($tdlist[2]) ? trim($tdlist[2]) : '';
                    $default = isset($tdlist[3]) && !empty($tdlist[3]) ? trim($tdlist[3]) : '';
                    if (!empty($name)) {
                        $arrstr .= "'" . strip_tags($name) . "' => array(" . PHP_EOL;
                        $arrstr .= "'desc'=> '" . strip_tags($desc) . "'," . PHP_EOL;
                        $arrstr .= "'type'=> '" . strip_tags($type) . "'," . PHP_EOL;
                        $arrstr .= "'default'=> '" . strip_tags($default) . "'," . PHP_EOL;
                        $arrstr .= ")," . PHP_EOL;
                    }

                }
            }
        }
        $arrstr .= ');';
        return $arrstr;
    }

}

<?php


namespace app\controllers;


use Yii;
use yii\web\Controller;
use yii\helpers\Url;
use app\services\wechart\WechatCheck;
use app\services\utility\xml\XmlFile;
use app\services\business\wechat\WechatUser;
use app\services\business\Job;


/**
 * 微信接口接受控制器
 */
class WechatController extends Controller
{
    public $enableCsrfValidation = false;


    private $opidList;

    public function init()
    {
        parent::init();
        $this->opidList = array('ryan' => 'oDhFvwptqslLm2ScSu-ZMK2k3RP4'); //管理员id
    }


    /**
     * 处理微信的操作
     * $wxtoken = new WechatCheck();
     * $wxtoken->valid();
     */
    public function actionIndex()
    {
        $xmlstr = file_get_contents("php://input");
        if (!empty($xmlstr)) {
            try {
                libxml_disable_entity_loader(true);
                $postObj = simplexml_load_string($xmlstr, 'SimpleXMLElement', LIBXML_NOCDATA);
                $msgType = $postObj->MsgType;
                $Content = $postObj->Content;
                if (strtolower($msgType) == 'event') {
                    $eventName = $postObj->Event;
                    switch ($eventName) {
                        case 'unsubscribe':
                        case 'subscribe' :
                            $this->_subscribe($postObj);
                            $welcome = "你好,欢迎关注邢台招聘咨询".PHP_EOL;
                            $welcome .= "回复任意内容获取招聘信息".PHP_EOL;
                            $welcome .= "或访问 http://debode.com.cn".PHP_EOL;
                            $welcome .= "如需发布招聘信息。请将内容直接回复到本公众号中。预计7月底将完成个人简历和发布招聘信息的功能.敬请期待..".PHP_EOL;
                            $this->_textMsg($postObj, $welcome);
                            break;
                    }
                } else {
                    $fromUsername = $postObj->FromUserName;
                    if (in_array($fromUsername, $this->opidList)) {  //如果是管理员留言，做一些特别处理
                        $this->_admin($postObj, $Content);
                    } else {
                        $this->_getPost($postObj);   //普通用户留言
                    }
                }
            } catch (\Exception $e) {
                $this->_textMsg($postObj, '添加失败' . print_r($e->getMessage(), true)); //显示错误信息
            }
        } else {
            Yii::$app->response->content = 'success';
        }
        return Yii::$app->response;
    }


    /**
     * 回复文本消息
     */
    private function _textMsg($postObj, $content = '欢迎', $msgtype = 'text')
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $sendData = array(
            'ToUserName' => $fromUsername,
            'FromUserName' => $toUsername,
            'CreateTime' => time(),
            'MsgType' => $msgtype,
            'Content' => $content,
        );
        $send = XmlFile::arrToXml($sendData, 'xml', true);
        $re = str_replace('<?xml version="1.0"?>', '', $send);
        $res = preg_replace('/(<CreateTime>)<!\[CDATA\[(\d+)\]\]>(<\/CreateTime>)/', '$1$2$3', $re);
        Yii::$app->response->content = $res;
        Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
    }


    /**
     *回复图文消息
     * 弊端只能发送一条图文信息，后面的item会覆盖前面的。限制8条以内
     */
    private function _articleList($postObj, $articleList = null)
    {
        $fromUsername = $postObj->FromUserName;
        $toUsername = $postObj->ToUserName;
        $sendData = array(
            'ToUserName' => $fromUsername,
            'FromUserName' => $toUsername,
            'CreateTime' => time(),
            'MsgType' => 'news',
            'ArticleCount' => count($articleList),
            'Articles' => $articleList,
        );
        $send = XmlFile::noKeyArrToXml($sendData, 'xml', true, false, 'item');
        $re = str_replace('<?xml version="1.0"?>', '', $send);
        $res = preg_replace('/(<CreateTime>)<!\[CDATA\[(\d+)\]\]>(<\/CreateTime>)/', '$1$2$3', $re);
        $res = preg_replace('/(<ArticleCount>)<!\[CDATA\[(\d+)\]\]>(<\/ArticleCount>)/', '$1$2$3', $res);
        Yii::$app->response->content = $res;
        Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
    }


    /**
     * 回复图文信息，数据根据而业务逻辑在这里处理
     */
    private function _getPost($postObj, $listData = null)
    {
        $articleList = array(
            array(
                'Title' => '查看信息',
                'Description' => '查看招聘数据',
                'PicUrl' => Url::home(true) . 'public/img/cbd.jpg',
                'Url' => Url::home(true),
            ),
        );
        if (is_array($listData)) {
            $articleList = $listData;
        }
        if (is_string($listData)) $articleList[0]['Url'] = $listData;
        $this->_articleList($postObj, $articleList);
    }


    /**
     * 订阅和取消订阅事件
     */
    private function _subscribe($postObj)
    {
        $fromUsername = $postObj->FromUserName;
        if ($postObj->Event == 'subscribe') {
            WechatUser::addUser($fromUsername);
        } else {
            WechatUser::updateUser($fromUsername);
        }
    }


    private function _admin($postObj, $Content)
    {
        if (!is_numeric($Content)) {
            switch ($Content) {
                case '查看': //查看文章列表
                    $this->_getPost($postObj);
                    break;
                case '管理': //可以删除文章列表
                    $this->_getPost($postObj, Url::to(['job/ryan-admin'], true));
                    break;
                default://添加文章信息
                    $this->_addJobItem($postObj, $Content);
            }
        }
    }


    private function _addJobItem($postObj, $Content)
    {
        try {
            $data = explode('|', $Content);
            $jobData['title'] = isset($data[1]) ? trim($data[1]) : '最新信息';
            $jobData['body'] = $data[0];
            $jobData['body'] = str_replace("/\s*\t*\r*\n*/", '<br>', $jobData['body']);
            $res = Job::addJob($jobData);
            $this->_textMsg($postObj, '已添加' . print_r($jobData, true)); //回复文本消息
        } catch (\Exception $e) {
            $this->_textMsg($postObj, '添加失败' . print_r($e->getMessage(), true)); //回复文本消息
        }
    }

    private function _log($msg, $fileName = null, $append = true)
    {
        if (empty($fileName)) {
            $fileName = Yii::getAlias('@app' . '/rawlog.txt');
        }
        $serialize = serialize($msg);
        if ($append) {
            file_put_contents($serialize, $fileName, FILE_APPEND);
        } else {
            file_put_contents($serialize, $fileName);
        }
    }








}

<?php

namespace app\services\wechart;

use app\services\wechart\WechartErrCode;
use app\services\network\http\HttpService;

use Yii;

/**
 * 微信API接口
 */
class WechatApi
{

    private static $appIdTest = 'wx9c6122f69a9b7778';

    private static $secretTest = '0905b2b9d72b3728ba045407421109be';

    public static function getAccessToken()
    {
        $r = self::_getAccessToken();
        if($r !== false){
         return $r;
        }
        $api = 'https://api.weixin.qq.com/cgi-bin/token';
        $params = array();
        $params['grant_type'] = 'client_credential';
        $params['appid'] = self::$appIdTest;
        $params['secret'] = self::$secretTest;
        $body = HttpService::httpGet($api, $params);
        $data = json_decode($body, true);
        if (isset($data['errcode'])) {
            Yii::info('获取accesstoken失败' . WechartErrCode::$code[$data['errcode']], 'wechat');
            return false;
        } else {
            //存储accessToken并且更新时间 $data['expires_in']
            self::_saveAccessToken($data['access_token'] , $data['expires_in']);
            return $data['access_token'];
        }
    }


    private static function _getAccessToken()
    {
        try {
            $data = Yii::$app->sqlite->createCommand("SELECT * FROM wechat_accesstoken LIMIT 1")->queryAll();
            if (empty($data)) {
                 return false;
            }
            if (time() >= $data[0]['uptime']) {
                return false;
            }
            return $data[0]['accesstoken'];
        } catch (\Exception $e) {
            Yii::error($e->getMessage(), 'wechat');
            return false;
        }
    }

    public static function _saveAccessToken($token, $tm)
    {
        try {
            $uptm = strtotime('+ ' . $tm . ' second');
            $data = Yii::$app->sqlite->createCommand("SELECT * FROM wechat_accesstoken LIMIT 1")->queryAll();
            if (empty($data)) {
                Yii::$app->sqlite->createCommand("INSERT INTO wechat_accesstoken (accesstoken, uptime) VALUES ('" . $token . "' , '" . $uptm . "')")->execute();
            } else {
                Yii::$app->sqlite->createCommand("UPDATE wechat_accesstoken SET accesstoken='" . $token . "' , uptime='" . $uptm . "'")->execute();
            }
        } catch (\Exception $e) {
            Yii::error('更新Accesstoken失败' . $e->getMessage());
        }

    }


}
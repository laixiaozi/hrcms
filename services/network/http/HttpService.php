<?php

namespace app\services\network\http;
use Yii;
/**
 * 网络请求接口
 */

class HttpService
{

    /**
     *发送Get请求
     */
    public static function httpGet($url, $param = array(), $headers = array())
    {
        $data = array();
        $query = http_build_query($param);
        $url .= '?'.$query;
        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            curl_close($ch);
        } catch (\Exception $e) {
            $data = $e->getMessage();
        }
        return $data;
    }

}
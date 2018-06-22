<?php

namespace app\services\business\wechat;

use Yii;
use app\services\business\common\Sqlite;

/**
 * 微信用户的处理
 */
class WechatUser
{

    private static $tableName = 'wechat_user';

    /**
     * 查询并添加一个用户
     */
    public static function addUser($openid)
    {
        $user = self::getUser($openid);
        if (empty($user)) {
            $sql = "INSERT INTO `" . self::$tableName . "` (open_id ,subscribe_tm) VALUES ('{$openid}','" . time() . "')";
            Sqlite::execute($sql);
        }
    }

    /**
     * 获取用户信息
     */
    public static function getUser($openid)
    {
        $sql = 'SELECT  *  FROM  `' . self::$tableName . '` WHERE open_id = "' . $openid . '"';
        return Sqlite::query($sql);
    }

    /**
     *更新用户取消关注时间
     */
    public static function updateUser($openid)
    {
        $sql = "UPDATE `" . self::$tableName . "` SET unsubscribe_tm = '" . time() . "'";
        return Sqlite::execute($sql);
    }


}
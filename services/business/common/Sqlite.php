<?php

namespace app\Services\business\common;

/**
 * 公共业务模块
 */
use Yii;

class Sqlite
{


    public static function execute($sql)
    {
        return Yii::$app->sqlite->createCommand($sql)->execute();
     }

    public static function query($sql)
    {
        return Yii::$app->sqlite->createCommand($sql)->queryAll();
    }

}
<?php

namespace app\widget\iview;

use yii\base\Widget;
use yii\helpers\Html;

/**
 * 日期小部件
 */

/**
 * 常见的日期和时间格式
 * 名称    说明    示例
 * yyyy    年份（四位）    2016
 * yy    年份（两位）    16
 * MM    月份（两位）    01
 * M    月份（一位）    1
 * MMMM    月份（英文）    January
 * MMM    月份（英文简写）    Jan
 * dd    日期（两位）    01
 * d    日期（一位）    1
 * Do    日期（简写）    1st
 * DD    星期（两位）    00
 * D    星期（一位）    0
 * dddd    星期（英文）    Monday
 * ddd    星期（英文简写）    Mon
 * HH    小时（24小时制两位）    01
 * H    小时（24小时制一位）    1
 * hh    小时（12小时制两位）    01
 * h    小时（12小时制一位）    1
 * mm    分钟（两位）    01
 * m    分钟（一位）    1
 * ss    秒钟（两位）    01
 * s    秒钟（一位）    1
 * SSS    毫秒（三位）    019
 * SS    毫秒（两位）    01
 * S    毫秒（一位）    1
 * A    上午与下午（大写）    AM/PM
 * a    上午与下午（小写）    am/pm
 * ZZ    时区    +0800
 *
 * 以上是 iView 支持的日期格式，你可以自由组合出你需要的类型，例如：
 *
 * yyyy年M月d日：2016年1月1日
 * MM/dd/yy：12/24/16
 * H点m分s秒：9点41分0秒
 */
class Datepicker extends Widget
{

    public $message;

    public $config;

    public function init()
    {
        parent::init();
        if (is_null($this->message)) {
            $this->message = '你好,世界';
        }

        if (is_null($this->config)) {
            $this->config = array();
        }
    }


    public function run()
    {
        $code = $this->createCode($this->config);
        return $code;
    }


    public function createCode($config)
    {
        $code = '<date-picker ';
        // type: date | datetime | datetimerange | year | month
        if (!isset($config['type']) || is_null($config['type'])) {
            $code .= ' type="date"';
        } else {
            $code .= ' type="' . $config['type'] . '"';
        }

        if (isset($config['split-panels'])) {
            $code .= '  ' . $config['split-panels'] . ' ';
        }

        if (isset($config['multiple'])) {
            $code .= '  ' . $config['multiple'] . ' ';
        }

        if (isset($config['show-week-numbers'])) {
            $code .= '  ' . $config['show-week-numbers'] . ' ';
        }

        if (isset($config['start-date'])) {
            $year = date("Y", strtotime($config['start-date']));
            $month = date('m', strtotime($config['start-date']));
            $day = date('d', strtotime($config['start-date']));
            $code .= ' v-bind:start-date= "new Date(' . $year . ',' . $month . ',' . $day . ')"';
        }

        if (isset($config['format'])) {
            $code .= '  format="' . $config['format'] . '" ';
        } else {
            $code .= '  format="yyyy-MM-dd" ';
        }

        /**
         * 设置属性 options 对象中的 disabledDate 可以设置不可选择的日期。
         *
         * disabledDate 是函数，参数为当前的日期，需要返回 Boolean 是否禁用这天。
         */

        if (isset($config['options'])) {
            $code .= ' v-bind:options= "' . $config['options'] . '"';
        }


        /**
         * 设置属性 confirm，选择日期后，选择器不会主动关闭，需用户确认后才可关闭。
         *
         * 确认按钮并没有影响日期的正常选择
         */
        if (isset($config['confirm'])) {
            $code .= '  ' . $config['confirm'] . ' ';
        }

        if (isset($config['size'])) {
            $code .= '  size="' . $config['size'] . '" ';
        }

        $code .= '>' . PHP_EOL;
        $code .= '</date-picker>' . PHP_EOL;
        return $code;
    }


}
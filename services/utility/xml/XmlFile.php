<?php

namespace app\services\utility\xml;

/**
 * 处理xml文件
 */
class XmlFile
{

    public static $xmlDom;

    public static $xmlElementRoot;

    /**
     * 数组转换成XML数据，要求数组格式必须是key => valu格式
     * @param $data    需要转换的数组
     * @param  $root   xml根节点
     * @param  $cdata  是否生成cData数据
     * @return  xml
     */
    public static function arrToXml($data, $root = 'xml', $cdata = false, $header = false)
    {
        if ($header) {
            self::$xmlDom = new \DOMDocument('1.0', 'utf-8');
        } else {
            self::$xmlDom = new \DOMDocument();
        }
        self::$xmlElementRoot = self::$xmlDom->createElement($root);
        self::parseArr($data, self::$xmlDom, self::$xmlElementRoot, $cdata);
        self::$xmlDom->appendChild(self::$xmlElementRoot);
        return self::$xmlDom->saveXML();
    }


    /**
     * 数组转换成XML数据，数组格式不必是key => valu格
     * @param $data    需要转换的数组
     * @param  $root   xml根节点
     * @param  $cdata  是否生成cData数据
     * @return  xml
     */
    public static function noKeyArrToXml($data, $root = 'xml', $cdata = false, $header = false , $defaultKey = 'default')
    {
        if ($header) {
            self::$xmlDom = new \DOMDocument('1.0', 'utf-8');
        } else {
            self::$xmlDom = new \DOMDocument();
        }
        self::$xmlElementRoot = self::$xmlDom->createElement($root);
        self::parseArrNoKey($data, self::$xmlDom, self::$xmlElementRoot, $cdata , $defaultKey);
        self::$xmlDom->appendChild(self::$xmlElementRoot);
        return self::$xmlDom->saveXML();
    }


    /**
     * 解析数组,要求数组格式必须是key => valu格式
     * @param $data 处理的数组数据，可以包含子数组
     * @param $xmlobj  \DOMDocument对象
     * @param  $dom    \DOMDocument 对象的根节点对象，
     * @return  xmlElement对象一般是根节点
     */
    public static function parseArr($data, $xmlobj, $dom, $cdata = false)
    {
        foreach ($data as $k => $value) {
            $element = self::$xmlDom->createElement($k);
            if (is_array($value)) {
                self::parseArr($value, $xmlobj, $element, $cdata);
                $dom->appendChild($element);
            } else {
                if ($cdata) {
                    $node = $xmlobj->createCDATASection($value);
                } else {
                    $node = $xmlobj->createTextNode($value);
                }
                $element->appendChild($node);
                $dom->appendChild($element);
            }
        }
        return $dom;
    }


    /**
     * 解析数组, 数组格式不必须是key => valu格式
     * @param $data 处理的数组数据，可以包含子数组
     * @param $xmlobj  \DOMDocument对象
     * @param  $dom    \DOMDocument 对象的根节点对象，
     * @return  xmlElement对象一般是根节点
     */
    public static function parseArrNoKey($data, $xmlobj, $dom, $cdata = false, $defaultKey = 'default')
    {
        foreach ($data as $k => $value) {
            if (is_numeric($k)) { //如果没拿到key ,默认就会是一个数字key
                 $element = self::$xmlDom->createElement($defaultKey);
            } else {
                $element = self::$xmlDom->createElement($k);
            }
            if (is_array($value)) {
                self::parseArrNoKey($value, $xmlobj, $element, $cdata , $defaultKey);
                $dom->appendChild($element);
            } else {
                if ($cdata) {
                    $node = $xmlobj->createCDATASection($value);
                } else {
                    $node = $xmlobj->createTextNode($value);
                }
                $element->appendChild($node);
                $dom->appendChild($element);
            }
        }
        return $dom;
    }


} //--class end
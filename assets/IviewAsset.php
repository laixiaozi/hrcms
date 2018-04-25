<?php

namespace app\assets;

use yii\web\AssetBundle;

/**
 * iview主题 前端资源
 */
class IviewAsset extends AssetBundle
{

    public $sourcePath = '@iview/public';
    public $baseUrl = '@web';


    public $js = [
        'vue.js',
        'axios/dist/axios.js',
        'iview/dist/iview.js',
    ];

    public $css = [
        'iview/dist/styles/iview.css',
    ];

    public $cssOptions = [
        'position' => \yii\web\View::POS_HEAD,
    ];

    //js放在页面的顶部还是底部
    public $jsOptions = [
//        'position' => \yii\web\View::POS_HEAD,
    ];

}
<?php
/**
 * mui资源管理
 */

namespace app\assets;

use Yii;
use yii\web\AssetBundle;

class MuiAsset extends AssetBundle
{
    public $sourcePath = '@mui/public';

    public $baseUrl = '@web';

    public $js = array(
        'dist/js/mui.min.js',
    );

    public $css = array(
        'dist/css/mui.min.css'
    );

    public $jsOptions = array(
        'position' => yii\web\View::POS_END,
    );

    public $cssOptions = array(
        'position' => yii\web\View::POS_HEAD,
    );


}
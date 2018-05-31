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
        'plugin/picker/js/mui.picker.js',
        'plugin/picker/js/mui.poppicker.js',
        'plugin/picker/js/mui.dtpicker.js'
    );

    public $css = array(
        'dist/css/mui.min.css',
        'plugin/picker/css/mui.dtpicker.css',
        'plugin/picker/css/mui.picker.css',
        'plugin/picker/css/mui.poppicker.css'
    );

    public $jsOptions = array(
        'position' => yii\web\View::POS_END,
    );

    public $cssOptions = array(
        'position' => yii\web\View::POS_HEAD,
    );


}
<?php

namespace app\widget\mui;

/**
 * 需要和 mui-content放在同级目录，也就是顶级目录
 * 侧滑菜单http://dev.dcloud.net.cn/mui/ui/#offcanvas
 *
 */
use Yii;
use yii\base\Widget;

class MuiOffcanvas extends Widget
{

    public $title;

    public $show;

    public $view;

    public $menuItems;

    public function init()
    {
        parent::init();
        if (empty($this->title)) {
            $this->title = '测试标题';
        }
        if (empty($this->view)) {
            $this->view = Yii::$app->getView();
        }
        ob_start();

    }

    public function run()
    {
        $this->Js();
        $code = $this->getHeadcode();
        $code .= ob_get_clean();
        $code .= $this->getFootCode();
        return $code;
    }

    public function getFootCode()
    {
        $code = <<<COD
                  </div>
                </div>  
              </div>
            </div>
COD;
        return $code;
    }

    public function getHeadcode()
    {
        $code = <<<COD
            <!-- 侧滑导航根容器 -->
            <div class="mui-off-canvas-wrap mui-draggable">
              <!-- 菜单容器 -->
              <aside class="mui-off-canvas-left" id="offCanvasSide">
                <div class="mui-scroll-wrapper" id="offCanvasSideScroll">
                  <div class="mui-scroll">
                    <!-- 菜单具体展示内容 -->
                        <div style="margin:10% auto 10%;color:#ddd;">
                            <p class="log" style="background:#ddd;border-radius:6px;width:30%;margin-left:10%;height: 50px;line-height: 50px;text-align: center;"> </p>
                            <h3 style="text-indent:10%;">{$this->title}</h3>
                        </div>
                         <ul class ='mui-table-view mui-table-view-chevron mui-table-view-inverted'>
                                <li class="mui-table-view-cell">-------------</li>
                        </ul>
                  </div>
                  <!-- 菜单具体展示内容END -->
                </div>
              </aside>
              <!-- 主页面容器 -->
              <div class="mui-inner-wrap">
                <!-- 主页面标题 -->
                <header class="mui-bar mui-bar-nav">
                  <a  href="#offCanvasSide" class="mui-icon mui-action-menu mui-icon-bars mui-pull-left"></a>
                  <h1 class="mui-title">{$this->title}</h1>
                </header>
                <div class="mui-content mui-scroll-wrapper" id="offCanvasContentScroll">
                  <div class="mui-scroll">
                    <!-- 主界面具体展示内容 -->
COD;
        return $code;
    }

    /**
     * 动画2：缩放式侧滑（类手机QQ）
     *
     * 该种动画要求的DOM结构和动画1的DOM结构基本相同，唯一差别就是需在侧滑导航根容器class上增加一个mui-scalable类
     * 动画3：主界面不动、菜单移动
     *
     * 该种动画要求的DOM结构和动画1的DOM结构基本相同，唯一差别就是需在侧滑导航根容器class上增加一个mui-slide-in类
     * 动画4：主界面、菜单同时移动
     *
     * 该种动画要求的DOM结构较特殊，需将菜单容器放在主页面容器之下
     * <!-- 侧滑导航根容器 -->
     * <div class="mui-off-canvas-wrap mui-draggable">
     * <!-- 主页面容器 -->
     * <div class="mui-inner-wrap">
     * <!-- 菜单容器 -->
     * <aside class="mui-off-canvas-left">
     * <div class="mui-scroll-wrapper">
     * <div class="mui-scroll">
     * <!-- 菜单具体展示内容 -->
     * ...
     * </div>
     * </div>
     * </aside>
     * <!-- 主页面标题 -->
     * <header class="mui-bar mui-bar-nav">
     * <a class="mui-icon mui-action-menu mui-icon-bars mui-pull-left"></a>
     * <h1 class="mui-title">标题</h1>
     * </header>
     * <!-- 主页面内容容器 -->
     * <div class="mui-content mui-scroll-wrapper">
     * <div class="mui-scroll">
     * <!-- 主界面具体展示内容 -->
     * ...
     * </div>
     * </div>
     * </div>
     * </div>
     */
    public function getCode()
    {
        $code = <<<COD
            <!-- 侧滑导航根容器 -->
            <div class="mui-off-canvas-wrap mui-draggable">
              <!-- 菜单容器 -->
              <aside class="mui-off-canvas-left" id="offCanvasSide">
                <div class="mui-scroll-wrapper">
                  <div class="mui-scroll">
                    <!-- 菜单具体展示内容 -->
                    Menu
                  </div>
                </div>
              </aside>
              <!-- 主页面容器 -->
              <div class="mui-inner-wrap">
                <!-- 主页面标题 -->
                <header class="mui-bar mui-bar-nav">
                  <a href="#offCanvasSide" class="mui-icon mui-action-menu mui-icon-bars mui-pull-left"></a>
                  <a class="mui-icon mui-action-menu mui-icon-bars mui-pull-left"></a>
                  <h1 class="mui-title">标题</h1>
                </header>
                <div class="mui-content mui-scroll-wrapper">
                  <div class="mui-scroll">
                    <!-- 主界面具体展示内容 -->
                    ...
                  </div>
                </div>  
              </div>
            </div>
COD;
        return $code;
    }

    public function Js()
    {
        $jscode = <<<JS
         //  mui("body").on('tap', '.offcanvas' , function(){
         //      console.log('打开策划菜单');
         //     mui('.mui-off-canvas-wrap').offCanvas('show');
         //  });
         // mui("body").on('tap', '.offcanvasclose' , function(){
         //      console.log('关闭菜单');
         //      mui(".mui-off-canvas-wrap").offCanvas().close(); 
         //  });
         mui('#offCanvasSideScroll').scroll();  
         mui('#offCanvasContentScroll').scroll();  
JS;
        $this->view->registerJs($jscode, \yii\web\View::POS_END);
    }


}



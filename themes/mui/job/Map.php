<?php
/*
 * 地图
*/
use app\widget\mui\MuiHeader;
use app\widget\mui\MuiSlide;
use app\widget\mui\MuiList;
use app\widget\mui\MuiGallery;
use app\widget\mui\MuiGridNine;
use app\widget\mui\MuiForm;
use app\widget\mui\MuiInput;
use app\widget\mui\MuiButton;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
$this->registerJsFile('http://webapi.amap.com/maps?v=1.4.6&key=3506317c8895788a170f01cb37761411' , [yii\web\View::POS_HEAD]);
$this->registerJsFile('http://g.alicdn.com/sj/lib/zepto/zepto.min.js' , [yii\web\View::POS_HEAD]);
?>
<?=MuiHeader::widget(['title' => '地图导航'])?>
<div class="mui-content">
     <div id="search">
          <?=MuiInput::widget(['config' => ['type' => 'search' ,'id'=> 'tipinput' ,'name' => 'tipinput']]); ?>
     </div>
    <div id="container" style=""></div>
    <!-- 结果面板 -->
    <div id="panel" class="hidden">
        <!-- 隐藏按钮 -->
        <a id="showHideBtn"></a>
        <div id="emptyTip">没有内容！</div>
        <!--搜索结果列表  city:'130502',-->
    </div>
</div>


<?php $this->beginBlock('home'); ?>
        mui.ready(function(){
        mui.init();
        document.getElementById('container').setAttribute('style','height:'+window.screen.height + 'px');
        if(mui.os.wechat == 'undefind' || mui.os.wechat == null){
            //console.log('非微信环境');
         }else{
           //console.log('微信环境');
         }

        var map = new AMap.Map('container', {
            resizeEnable: true,
            zoom: 12,
            center:[114.495118,37.070049],
        });

        AMap.plugin(['AMap.toolBar'],function(){
            var toolbar = new AMap.toolBar();
            map.addcontrol(toolbar);
        });

        AMap.service(["AMap.PlaceSearch", "AMap.Autocomplete" ] , function(){
            try{

                    //搜索框支持自动完成提示
                    var auto = new AMap.Autocomplete({
                        input: "tipinput",
                        city:'130502',
                    });

                    //构造地点查询类
                    var placeSearch = new AMap.PlaceSearch({
                        pageSize: 5,
                        pageIndex: 1,
                        map: map,
                        citylimit: true,
                        city:'130502',
                    });


                //监听搜索框的提示选中事件
                AMap.event.addListener(auto, "select", function(e) {
                        //设置搜索的城市
                        placeSearch.setCity(130502);
                        //开始搜索对应的poi名称
                         placeSearch.search(e.poi.name, function(status, results) {
                             if (results.pois && results.pois.length > 0) {
                                     $('#panel').toggleClass('empty');
                             }
                         });
                });
            }catch(e){
              console.error(e);
            }
        });

});
<?php $this->endBlock(); ?>
<?php $this->registerJs($this->blocks['home'], \yii\web\View::POS_END); ?>

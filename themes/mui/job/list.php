<?php
use yii\helpers\Url;
use app\services\business\Job;
use app\widget\mui\MuiHeader;
use app\widget\mui\MuiList;
?>
<?=MuiHeader::widget(['title'=>'列表页面'])?>
<?= $this->render('footer');?>

<div id="pullrefresh" class="mui-content mui-scroll-wrapper">
    <div class="mui-scroll">
        <!--数据列表-->
        <ul class="mui-table-view mui-table-view-chevron" id="datalist"></ul>
    </div>
</div>


<?php $this->beginBlock('listpage');?>

        mui.init({
            pullRefresh: {
                container: '#pullrefresh',
                down: {
                    style: 'circle',
                    callback: pulldownRefresh
                },
            up: {
                auto: true,
                contentrefresh: '正在加载...',
                callback: pullupRefresh
                }
            }
        });

        mui('ul').on('tap' , '.mui-table-view-cell' ,function(){
            var a = this.firstChild;
            window.location.href=a.href;
        });

        mui('#datalist').on('slideleft','.mui-table-view-cell',function(event){
         console.log(event);
        });


     var page =1;
     var totalPage = 0;
    function pullupRefresh() {
        setTimeout(function(){
            appendData();
            mui('#pullrefresh').pullRefresh().endPullupToRefresh(totalPage == page);
        },1500);
    }

    function  appendData(){
        var table = document.body.querySelector('.mui-table-view');
        var  cell = document.body.querySelector('.mui-table-view-cell');
        mui.ajax("<?=$request?>" ,{
                data:{page:page},
                dataType:'json',
                type: 'post',
                success:function(data){
                    if(data.data.length > 0){
                        totalPage = data.page;
                        for(i=0; i< data.data.length; i++){
                                var li = addElement(data.data[i].title , data.data[i].desc ,  data.data[i].href);
                                table.appendChild(li);
                        }
                        ++page;
                    }
                },
                error:function(xhr ,type, errorthrown){
                    console.log(type);
                    mui.alert("请求失败!");
                    this.endPullupToRefresh(true);
                }
        });
    }


   function addElement(title , desc , href){
        var li =document.createElement('li');
        var a =document.createElement('a');
        var span = document.createElement('span');
        var div  = document.createElement('div');
        var p    = document.createElement('p');
        li.setAttribute('class','mui-table-view-cell mui-media');
        a.setAttribute('href' , href);
        span.setAttribute('class' , 'mui-media-object mui-pull-left mui-icon mui-icon-chatboxes ');
        div.setAttribute('class' , 'mui-media-body');
        p.setAttribute('class' , 'mui-ellipsis');

        a.appendChild(span);
        p.innerText = desc.replace(/\n*/g,'');
        div.innerText=title;
        div.appendChild(p);
        a.appendChild(div);
        li.appendChild(a);
      return li;
   }


  //左滑显示菜单按钮
  function swipeButton(btnText){
       var div = document.createElement('div');
       var a  = document.createElement('a');
       div.setAttribute('class' , 'mui-slider-right mui-disabled');
       a.setAttribute('class' , 'mui-btn mui-btn-red');
       a.innerText = btnText;
       div.appendChild(a);
      return div;
  }


    function addData() {
        var table = document.body.querySelector('.mui-table-view');
        var  cell = document.body.querySelector('.mui-table-view-cell');
        mui.ajax("<?=$request?>" ,{
               data:{page:page},
               dataType:'json',
               type: 'post',
               success:function(data){
                 if(data.data.length > 0){
                    totalPage = data.page;
                     for(i=0; i< data.data.length; i++){
                          var li = addElement(data.data[i].title , data.data[i].desc ,  data.data[i].href);
                          table.insertBefore(li , table.firstChild);
                    }
                    ++page;
                  }
               },
               error:function(xhr ,type, errorthrown){
                  console.log(type);
                  mui.alert("请求失败!");
                  this.endPullupToRefresh(true);
               }
        });
    }

    /**
    * 下拉刷新具体业务实现
    */
    function pulldownRefresh() {
           setTimeout(function(){
              addData();
              mui('#pullrefresh').pullRefresh().endPulldownToRefresh();
            }, 1500);
    }



<?php $this->endBlock();?>
<?php $this->registerJs($this->blocks['listpage'] , \yii\web\View::POS_END);?>

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
            var div = this.firstChild;
            window.location.href=div.getAttribute('data');
        });

       mui('#datalist').on('tap' , '.mui-btn' , function(event){
             var id = this.getAttribute('data');
             var btna = event.srcElement ? event.srcElement : event.target;
             var    li = btna.parentNode.parentNode;
             var father = mui('#datalist')[0];
            mui.confirm('确认要删除吗 ?' , '删除',  ['删除' , '取消'] , function(e){
                  if(e.index == 0){
                     mui.ajax('<?=$delUrl?>', {
                                     data:{  id: id },
                                      type:'post',
                                      dataType:'json',
                                    success:function(data){
                                       if(data.code == 200){
                                             father.removeChild(li);
                                          }else{
                                           mui.alert('删除失败');
                                            console.log(data);
                                          }
                                    },
                                    error:function(xhr , type ,  errorthrow){
                                        console.log(type);
                                         mui.alert('删除失败' ,'删除结果');
                                    }
                                  });
                  }
            });
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
                                var li = addElement(data.data[i].title , data.data[i].desc ,  data.data[i].href , data.data[i].id);
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


   function addElement(title , desc , href ,id){
        var li =document.createElement('li');
        li.setAttribute('class','mui-table-view-cell');
        li.appendChild(liTxt(title , href));
        li.appendChild(swipeButton('删除' , id));
        li.appendChild(swipeRight('删除' , id));
      return li;
   }


  //左滑显示菜单按钮
  function swipeButton(btnText , id){
       var div = document.createElement('div');
       var a  = document.createElement('a');
       div.setAttribute('class' , 'mui-slider-right mui-disabled');
       a.setAttribute('class' , 'mui-btn mui-btn-red');
       a.setAttribute('data' ,  id);
       a.innerText = btnText;
       div.appendChild(a);
      return div;
  }

  //右滑按钮
  function swipeRight(btnText , id){
        var div = document.createElement('div');
        var a  = document.createElement('a');
        div.setAttribute('class' , 'mui-slider-left mui-disabled');
        a.setAttribute('class' , 'mui-btn mui-btn-red');
        a.setAttribute('data' ,  id);
        a.innerText = btnText;
        div.appendChild(a);
        return div;
  }


  function liTxt(txt , link){
        var div = document.createElement('div');
        div.setAttribute('class' , 'mui-slider-handle');
        div.setAttribute('data' , link);
        div.innerText = txt;
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
                          var li = addElement(data.data[i].title , data.data[i].desc ,  data.data[i].href ,  data.data[i].id);
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
